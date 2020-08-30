<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Yabacon\Paystack;

class PaymentController extends Controller
{
    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function verifyTransaction(Request $request)
    {
        $reference = isset($request->reference) ? $request->reference : '';
        if(!$reference){
            die('No reference supplied');
        }

        // initiate the Library's Paystack Object
        $paystack = new Paystack("secret_key");
        try
        {
            // verify using the library
            $tranx = $paystack->transaction->verify([
                'reference'=>$reference, // unique to transactions
            ]);
        } 
        catch(\Yabacon\Paystack\Exception\ApiException $e){
            dd($e->getResponseObject());
            dd($e->getMessage());
        }

        if ('success' === $tranx->data->status) {
            if($request->is('agents/*')):
                $route = 'agents/active-loads';
            else:
                $route = 'users/active-loads';
            endif;
            return redirect($route)->with('success', 'Bid accepted');
        }
        else{
            dd($tranx);
        }
    }
}
