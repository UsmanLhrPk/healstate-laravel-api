<?php

namespace App\Services;

use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class PaymentService
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * Create payment intent with dynamic currency
     */
    public function createPaymentIntent(float $amount, string $currency = 'USD', array $metadata = []): array
    {
        try {
            // Stripe requires currency in lowercase
            $currency = strtolower($currency);

            $paymentIntent = PaymentIntent::create([
                'amount' => $this->convertToSmallestUnit($amount, $currency),
                'currency' => $currency,
                'metadata' => $metadata,
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);

            return [
                'client_secret' => $paymentIntent->client_secret,
                'payment_intent_id' => $paymentIntent->id,
            ];
        } catch (ApiErrorException $e) {
            throw new \Exception('Payment intent creation failed: '.$e->getMessage());
        }
    }

    public function confirmPayment(string $paymentIntentId): array
    {
        try {
            $paymentIntent = PaymentIntent::retrieve($paymentIntentId);

            // Get currency to convert back properly
            $currency = strtoupper($paymentIntent->currency);

            return [
                'status' => $paymentIntent->status,
                'payment_intent_id' => $paymentIntent->id,
                'amount' => $this->convertFromSmallestUnit($paymentIntent->amount, $currency),
                'currency' => $currency,
            ];
        } catch (ApiErrorException $e) {
            throw new \Exception('Payment confirmation failed: '.$e->getMessage());
        }
    }

    public function refundPayment(string $paymentIntentId, ?float $amount = null, ?string $currency = 'USD'): array
    {
        try {
            $refundData = ['payment_intent' => $paymentIntentId];

            if ($amount && $currency) {
                $refundData['amount'] = $this->convertToSmallestUnit($amount, strtolower($currency));
            }

            $refund = \Stripe\Refund::create($refundData);

            $refundCurrency = strtoupper($refund->currency);

            return [
                'refund_id' => $refund->id,
                'status' => $refund->status,
                'amount' => $this->convertFromSmallestUnit($refund->amount, $refundCurrency),
                'currency' => $refundCurrency,
            ];

        } catch (ApiErrorException $e) {
            // Charge was already fully refunded — treat as success so the
            // order can still be marked cancelled in our DB.
            if ($e->getStripeCode() === 'charge_already_refunded') {
                \Illuminate\Support\Facades\Log::warning(
                    "Refund skipped — charge already refunded for payment intent: {$paymentIntentId}"
                );

                $paymentIntent = PaymentIntent::retrieve($paymentIntentId);
                $existingRefund = \Stripe\Refund::all(['payment_intent' => $paymentIntentId, 'limit' => 1])->first();
                $refundCurrency = strtoupper($paymentIntent->currency);

                return [
                    'refund_id' => $existingRefund?->id ?? 'already_refunded',
                    'status' => $existingRefund?->status ?? 'succeeded',
                    'amount' => $this->convertFromSmallestUnit(
                        $existingRefund?->amount ?? $paymentIntent->amount_received,
                        $refundCurrency
                    ),
                    'currency' => $refundCurrency,
                ];
            }

            throw new \Exception('Refund failed: '.$e->getMessage());
        }
    }

    /**
     * Convert amount to smallest currency unit (cents for USD, etc.)
     * Some currencies don't use decimal places (JPY, KRW)
     */
    private function convertToSmallestUnit(float $amount, string $currency): int
    {
        $currency = strtoupper($currency);

        // Zero-decimal currencies (no cents/pence)
        $zeroDecimalCurrencies = ['JPY', 'KRW', 'VND', 'CLP', 'ISK'];

        if (in_array($currency, $zeroDecimalCurrencies)) {
            return (int) round($amount);
        }

        // Standard currencies (cents/pence) - multiply by 100
        return (int) round($amount * 100);
    }

    /**
     * Convert from smallest unit back to standard decimal
     */
    private function convertFromSmallestUnit(int $amount, string $currency): float
    {
        $currency = strtoupper($currency);

        // Zero-decimal currencies
        $zeroDecimalCurrencies = ['JPY', 'KRW', 'VND', 'CLP', 'ISK'];

        if (in_array($currency, $zeroDecimalCurrencies)) {
            return (float) $amount;
        }

        // Standard currencies
        return $amount / 100;
    }
}
