<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Models\Cart;
use App\Models\Order;
use Livewire\Component;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\InvoiceOrderMailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutShow extends Component
{   
    public $fullname,$email,$phone,$address,$pincode;
    public $totalAmount,$carts;
    public $payment_mode,$payment_id=null;
    protected $listeners=['validationForAll','transactionEmit'=>'paidOnlineOrder'];
    public function validationForAll(){
        $this->validate();
    }
    public function mount(){
        $this->fullname=auth()->user()->name;
        $this->email=auth()->user()->email;
        $this->phone=auth()->user()->userDetail->phone;
        $this->address=auth()->user()->userDetail->address;
        $this->pincode=auth()->user()->userDetail->pincode;
    }
    public function totalCartAmount(){
        $this->toalAmount=0;
        $this->carts=Cart::where('user_id',auth()->user()->id)->get();
        foreach($this->carts as $cartItem){
            $this->totalAmount += $cartItem->product->selling_price * $cartItem->quantity; 
        }
        return $this->totalAmount;
    }

    public function rules(){
        return [
            'fullname'=>'required|string|max:121',
            'email'=>'required|email',
            'phone'=>'required|string|min:10|max:10',
            'pincode'=>'required|string|min:6|max:6',
            'address'=>'required|string|max:500'
        ];
    }
    public function placeOrder(){
        $this->validate();
        $order=Order::create([
            'user_id'=>auth()->user()->id,
            'tracking_no'=>Str::random(10),
            'fullname'=>$this->fullname,'email'=>$this->email,
            'phone'=>$this->phone,'pincode'=>$this->pincode,
            'address'=>$this->address,
            'status_message'=>'in progress',
            'payment_mode'=>$this->payment_mode,
            'payment_id'=>$this->payment_id
        ]);
        foreach($this->carts as $cartItem){
            $orderItem=OrderItem::create([
                'order_id'=>$order->id,
                'product_id'=>$cartItem->product_id,
                'quantity'=>$cartItem->quantity,
                'price'=>$cartItem->product->selling_price
            ]);
        }

        $data=['order'=>$order];
        $pdf = Pdf::loadView('admin.invoice.generate-invoice', $data);
        $data1['order']=$order;
        $data1['pdf']=$pdf;
        $data1['subject']=$order->status_message;
        try{      
          Mail::to($order->email)->send(new InvoiceOrderMailable($data1));
     }
        catch(\Exception $e ){
        }

        return $order;
    }
    public function codorder(){
          $this->payment_mode="Cash on Delivery";
          $codorder=$this->placeOrder();
          if($codorder){
            Cart::where('user_id',auth()->user()->id)->delete();
            $this->emit('cartAddedOrUpdated');
            $this->dispatchBrowserEvent('message', [
                'text' => "Order Placed",
                'type'=>'success',
                'status'=>200            
            ]);
            return redirect()->to('thank-you');
        }
        else {
            $this->dispatchBrowserEvent('message', [
                'text' => "something went wrong",
                'type'=>'error',
                'status'=>404           
            ]);
        }
    }

    public function paidOnlineOrder($id){
        $this->payment_id=$id;
        $this->payment_mode="Paid Online";
        $onlineorder=$this->placeOrder();
        if($onlineorder){
            Cart::where('user_id',auth()->user()->id)->delete();
            $this->emit('cartAddedOrUpdated');
            $this->dispatchBrowserEvent('message', [
                'text' => "Order Placed",
                'type'=>'success',
                'status'=>200            
            ]);
            return redirect()->to('thank-you');
        }
        else {
            $this->dispatchBrowserEvent('message', [
                'text' => "something went wrong",
                'type'=>'error',
                'status'=>404           
            ]);
        }
    }
    public function render()
    {   $this->totalAmount=$this->totalCartAmount();
        return view('livewire.frontend.checkout.checkout-show',
        ['fullname'=>$this->fullname,'email'=>$this->email,'phone'=>$this->phone,'address'=>$this->address,'pincode'=>$this->pincode]);
    }

}
