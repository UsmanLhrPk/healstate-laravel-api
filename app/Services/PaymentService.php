<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Exception\ApiErrorException;

class PaymentService
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    public function createPaymentIntent(float $amount, array $metadata = []): array
    {
        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $amount * 100, // Convert to cents
                'currency' => 'usd',
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
            throw new \Exception('Payment intent creation failed: ' . $e->getMessage());
        }
    }

    public function confirmPayment(string $paymentIntentId): array
    {
        try {
            $paymentIntent = PaymentIntent::retrieve($paymentIntentId);

            return [
                'status' => $paymentIntent->status,
                'payment_intent_id' => $paymentIntent->id,
                'amount' => $paymentIntent->amount / 100,
            ];
        } catch (ApiErrorException $e) {
            throw new \Exception('Payment confirmation failed: ' . $e->getMessage());
        }
    }

    public function refundPayment(string $paymentIntentId, ?float $amount = null): array
    {
        try {
            $refundData = ['payment_intent' => $paymentIntentId];
            
            if ($amount) {
                $refundData['amount'] = $amount * 100;
            }

            $refund = \Stripe\Refund::create($refundData);

            return [
                'refund_id' => $refund->id,
                'status' => $refund->status,
                'amount' => $refund->amount / 100,
            ];
        } catch (ApiErrorException $e) {
            throw new \Exception('Refund failed: ' . $e->getMessage());
        }
    }
}