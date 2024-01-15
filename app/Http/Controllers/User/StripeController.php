<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StripeController extends Controller
{
 
        public function StripeOrder(Request $request){

            \Stripe\Stripe::setApiKey('pk_test_51O7NNbBROqliipLidjuXV2clxbWHGpBuqWUKGF0BWX6PuqcDa4MG02IBf6faqfEZnH4bTyzg5GiIBdfmgzY59r5B00SPQnQsd4');
    
    
            $token = $_POST['stripeToken'];
    
            $charge = \Stripe\Charge::create([
              'amount' => 999*100,
              'currency' => 'usd',
              'description' => 'Easy Mulit Vendor Shop',
              'source' => $token,
              'metadata' => ['order_id' => '6735'],
            ]);
    
            dd($charge);


    }// End Method 


}
