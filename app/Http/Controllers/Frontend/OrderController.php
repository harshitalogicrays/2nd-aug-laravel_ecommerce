<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(){
        $orders=Order::where('user_id',auth()->user()->id)->get();
        return view('frontend.myorders',compact('orders'));
    }
    public function showorder($orderid){
        $order=Order::where('user_id',auth()->user()->id)->where('id',$orderid)->first();
        return view('frontend.vieworder',compact('order'));
    }
}
