<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkoutShow(){
        return view('frontend.checkout.checkout-show');
      }
      public function thankyou(){
        return view('frontend.checkout.thank-you');
    }
}
