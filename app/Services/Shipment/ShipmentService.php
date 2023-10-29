<?php

namespace App\Services\Shipment;

use Exception;

class ShipmentService {

    private $shipmentProvider;

    public function __construct($shipmentProvider) {
        $this->shipmentProvider = $shipmentProvider;
    }

    public function createShipment($orderDetails) {
        // Using the shipment provider to create a shipment
        $response = $this->shipmentProvider->bookShipment($orderDetails);
        // dd($response);
        if ($response->success) {
            return [
                'success' => true,
                'trackingNumber' => $response->trackingNumber
            ];
        } else {
            throw new Exception('Shipment failed: ' . $response->errorMessage);
        }
    }
}
