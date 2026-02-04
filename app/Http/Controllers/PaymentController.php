<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Services\Payment\PaymentManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    protected $paymentManager;
    
    public function __construct(PaymentManager $paymentManager)
    {
        $this->paymentManager = $paymentManager;
    }
    
    // eSewa Callbacks
    public function esewaCallback(Request $request)
    {
        try {
            $result = $this->paymentManager->verifyESewaPayment($request->all());
            
            if ($result['success']) {
                $donation = Donation::where('transaction_id', $result['transaction_id'])->first();
                if ($donation) {
                    $donation->update([
                        'status' => 'completed',
                        'payment_response' => $result
                    ]);
                }
                
                return redirect()->route('donate.success')->with('success', 'Payment successful!');
            }
            
            return redirect()->route('donate.cancel')->with('error', 'Payment verification failed.');
            
        } catch (\Exception $e) {
            Log::error('eSewa callback error: ' . $e->getMessage());
            return redirect()->route('donate.cancel')->with('error', 'Payment processing error.');
        }
    }
    
    public function esewaSuccess(Request $request)
    {
        return redirect()->route('donate.success');
    }
    
    public function esewaFailure(Request $request)
    {
        return redirect()->route('donate.cancel');
    }
    
    // Khalti Callbacks
    public function khaltiCallback(Request $request)
    {
        try {
            $result = $this->paymentManager->verifyKhaltiPayment($request->all());
            
            if ($result['success']) {
                $donation = Donation::where('transaction_id', $result['transaction_id'])->first();
                if ($donation) {
                    $donation->update([
                        'status' => 'completed',
                        'payment_response' => $result
                    ]);
                }
                
                return response()->json(['success' => true]);
            }
            
            return response()->json(['success' => false], 400);
            
        } catch (\Exception $e) {
            Log::error('Khalti callback error: ' . $e->getMessage());
            return response()->json(['success' => false], 500);
        }
    }
    
    public function khaltiSuccess(Request $request)
    {
        return redirect()->route('donate.success');
    }
    
    public function khaltiFailure(Request $request)
    {
        return redirect()->route('donate.cancel');
    }
}