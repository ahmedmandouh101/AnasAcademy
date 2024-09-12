<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function handleStripeWebhook(Request $request)
    {
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );


            switch ($event->type) {
                case 'payment_intent.succeeded':
                    $paymentIntent = $event->data->object;

                    break;



                default:
                    Log::info('Received unknown event type: ' . $event->type);
            }

            return response()->json(['status' => 'success']);
        } catch(\UnexpectedValueException $e) {

            return response()->json(['status' => 'invalid payload'], 400);
        } catch(\Stripe\Exception\SignatureVerificationException $e) {

            return response()->json(['status' => 'invalid signature'], 400);
        }
    }
}
