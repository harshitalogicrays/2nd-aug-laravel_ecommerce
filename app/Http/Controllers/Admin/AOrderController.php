<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\InvoiceOrderMailable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class AOrderController extends Controller
{     
 
    public function index(Request $request){
      // $orders= Order::paginate(2);
      // return view('admin.orders.index',compact('orders'));
      $todayDate=Carbon::now()->format('Y-m-d');
      $orders=Order::when($request->date !=null,function($q) use ($request){
          return $q->whereDate('created_at',$request->date);
      },function($q) use ($todayDate){
        // return $q->whereDate('created_at',$todayDate);
        return $q->orderBy('created_at',"desc");
      })->when($request->status !=null , function($q)use($request){
        return $q->where('status_message',$request->status );
      })->paginate(2);
      return view('admin.orders.index',compact('orders'));
    }
    public function showorder($orderid){
      $order=Order::where('id',$orderid)->first();
    return view('admin.orders.vieworder',compact('order'));

    }

    public function updateorderstatus($orderId,Request $request){
      $order=Order::where('id',$orderId)->first();
      if($order){
        $order->update([
          'status_message'=>$request->status
        ]);
      }
      return redirect('/admin/orders')->with('message','order status updated for order id '.$order->id);
    }

    public function invoice($id){
      $order=Order::find($id);
      return view('admin.invoice.generate-invoice',compact('order'));
    }

    public function downloadpdf($id){
      $order=Order::find($id);
      $data=['order'=>$order];
      $pdf = Pdf::loadView('admin.invoice.generate-invoice', $data);
      return $pdf->download('invoice'.$id.'.pdf');
    }
    public function sendinvoiceonmail($id){
      $order=Order::find($id);
      $data=['order'=>$order];
      $pdf = Pdf::loadView('admin.invoice.generate-invoice', $data);
      $data1['order']=$order;
      $data1['pdf']=$pdf;
      $data1['subject']=$order->status_message;
      try{      
        Mail::to($order->email)->send(new InvoiceOrderMailable($data1));
        return redirect('admin/orders')->with('message','invoice mail sent successfully to '. $order->email);
      }
      catch(\Exception $e ){
        return redirect('admin/orders')->with('message','something went wrong');
      }
    }
}
