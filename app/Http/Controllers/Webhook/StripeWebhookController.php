<?php

namespace App\Http\Controllers\Webhook;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;

/**
 * @group Webhooks
 * 
 * Stripe webhook handlers
 */
class StripeWebhookController extends Controller
{
    public function __construct(
        protected OrderService $orderService
    ) {}

    /**
     * Handle Stripe Webhook
     * 
     * Process Stripe webhook events for payment confirmations.
     */
    public function handleWebhook(Request $request): JsonResponse
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $webhookSecret = config('services.stripe.webhook_secret');

        try {
            $event = Webhook::constructEvent(
                $payload,
                $sigHeader,
                $webhookSecret
            );
        } catch (\UnexpectedValueException $e) {
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (SignatureVerificationException $e) {
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        // Handle the event
        switch ($event->type) {
            case 'payment_intent.succeeded':
                $this->handlePaymentSucceeded($event->data->object);
                break;

            case 'payment_intent.payment_failed':
                $this->handlePaymentFailed($event->data->object);
                break;

            default:
                // Unexpected event type
                break;
        }

        return response()->json(['status' => 'success']);
    }

    protected function handlePaymentSucceeded($paymentIntent): void
    {
        $order = Order::where('payment_intent_id', $paymentIntent->id)->first();

        if ($order && $order->status === 'pending') {
            $this->orderService->markOrderAsPaid($order, $paymentIntent->id);
        }
    }

    protected function handlePaymentFailed($paymentIntent): void
    {
        $order = Order::where('payment_intent_id', $paymentIntent->id)->first();

        if ($order) {
            $order->update(['status' => 'failed']);
        }
    }
}