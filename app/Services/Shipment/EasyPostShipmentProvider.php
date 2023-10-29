<?php

namespace App\Services\Shipment;

use EasyPost\EasyPostClient;
use Exception;

class EasyPostShipmentProvider {

    private $client;

    public function __construct($apiKey) {
        $this->client = new EasyPostClient($apiKey);
    }

    public function bookShipment($orderDetails) {
        try {
            
            $shipment = $this->client->shipment->create([
                "from_address" => $orderDetails['from'],
                "to_address" => $orderDetails['to'],
                "parcel" => $orderDetails['parcel'],
            ]);
    
            return $shipment;
        } catch (Exception $e) {
            return (object)[
                'success' => false,
                'errorMessage' => $e->getMessage()
            ];
        }
    }
    
}
