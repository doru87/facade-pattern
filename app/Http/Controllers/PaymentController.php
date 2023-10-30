<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessPayment;
use App\Services\Payment\PaymentGateway;
use Exception;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function index() {
        return view('payment');
    }

    // public function store(Request $request)
    // {
    //     $amount = $request->input('amount');
    //     $token = $request->input('stripeToken'); // Assuming you get the Stripe token from the request
    //     // dd($token);
    //     $paymentGateway = new PaymentGateway(config('services.stripe.secret'));

    //     try {
    //         $paymentSuccess = $paymentGateway->charge($amount, $token); // Here, 1000 could be dynamic based on what the user is buying
    //         if ($paymentSuccess) {
    //             // Handle successful payment logic, maybe redirect with success message
    //             return redirect()->back()->with('success', 'Payment successful!');
    //         }
    //     } catch (Exception $e) {
    //         // Handle payment failure logic, maybe redirect with error message
    //         return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    //     }
    // }

    // public function processPayment(Request $request)
    // {
    //     $amount = $request->input('amount');
    //     $token = $request->input('stripeToken');

    //     // Dispatch the job
    //     ProcessPayment::dispatch($amount, $token);

    //     return redirect()->back()->with('message', 'Payment is being processed.');
    // }

    public function newPayment(){

    }
}
