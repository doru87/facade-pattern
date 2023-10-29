<?php

namespace App\Jobs;

use App\Services\Payment\PaymentGateway;
use App\Services\Shipment\EasyPostShipmentProvider;
use App\Services\Shipment\ShipmentService;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessPayment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $amount;
    protected $token;

    /**
     * Create a new job instance.
     */
    public function __construct($amount, $token)
    {
        $this->amount = $amount;
        $this->token = $token;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $paymentGateway = new PaymentGateway(config('services.stripe.secret'));
        $shipmentService = new ShipmentService(new EasyPostShipmentProvider(config('services.easypost.secret')));
        
        try {
            $paymentSuccess = $paymentGateway->charge($this->amount, $this->token);
            if ($paymentSuccess) {
                // Handle successful payment logic, maybe send a success email or update database records

                $orderDetails = [
                    'from' => [
                        "company" => "EasyPost",
                        "street1" => "118 2nd Street",
                        "street2" => "4th Floor",
                        "city" => "San Francisco",
                        "state" => "CA",
                        "zip" => "94105",
                        "phone" => "415-456-7890",
                    ],
                    'to' => [
                        "name" => "Dr. Steve Brule",
                        "street1" => "179 N Harbor Dr",
                        "city" => "Redondo Beach",
                        "state" => "CA",
                        "zip" => "90277",
                        "phone" => "310-808-5243",
                    ],
                    'parcel' => [
                        'length' => 10.0,
                        'width' => 5.0,
                        'height' => 4.0,
                        'weight' => 15.0,
                    ]
                ];
                
                $shipmentResponse = $shipmentService->createShipment($orderDetails);
                dd($shipmentResponse);
                Log::info('Shipment Response:', ['response' => $shipmentResponse]);

            }
        } catch (Exception $e) {
            // Handle payment failure logic, maybe log the error or notify the user
            Log::error('Payment failure: Shipment failed: ' . $e->getMessage(), [
                'exception' => $e,
                'stack_trace' => $e->getTraceAsString(),
            ]);
            
            Log::error('Payment failure: ' . $e->getMessage());
        }
    }
}



