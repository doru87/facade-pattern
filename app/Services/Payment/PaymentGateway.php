<?php
namespace App\Services\Payment;

use Exception;

class PaymentGateway {

    private $apiKey;

//    public function __construct($apiKey) {
//        $this->apiKey = $apiKey;
//    }

    public function charge($amount, $creditCardToken) {
        $stripeService = new StripeService($this->apiKey);
        $response = $stripeService->makePayment($amount, $creditCardToken);

        if ($response->success) {
            return true;
        } else {
            throw new Exception('Payment failed: ' . $response->errorMessage);
        }
    }
}
