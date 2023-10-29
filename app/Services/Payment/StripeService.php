<?php 

namespace App\Services\Payment;

use Stripe\Stripe;
use Stripe\Charge;
use Exception;

class StripeService {

    private $apiKey;

    public function __construct($apiKey) {
        $this->apiKey = $apiKey;
        Stripe::setApiKey($this->apiKey);
    }

    public function makePayment($amount, $creditCardToken) {
        try {
            $response = Charge::create([
                'amount' => $amount,
                'currency' => 'usd', // Modify currency as needed
                'source' => $creditCardToken
            ]);

            if ($response->paid) {
                return (object)[
                    'success' => true
                ];
            } else {
                return (object)[
                    'success' => false,
                    'errorMessage' => 'Charge was not paid!'
                ];
            }
        } catch (\Stripe\Exception\ApiErrorException $e) {
            return (object)[
                'success' => false,
                'errorMessage' => $e->getMessage()
            ];
        }
    }
}
