<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Viewproduct extends Component
{   
    public $product,$category;
    public $qtyCount=1;
    public function mount($product,$category){
        $this->product=$product;
        $this->category=$category;
    }
    public function incrementQty(){
        if($this->qtyCount < $this->product->qty)
             $this->qtyCount++;
    }
    public function decrementQty(){
        if($this->qtyCount > 1)
             $this->qtyCount--;
        else 
            $this->qtyCount=1;
    }

    public function addToCart($productid){
        if(Auth::check()){
            if($this->product->where('id',$productid)->where('status','0')->exists()){
                Cart::create([
                    'user_id'=>auth()->user()->id,
                    'product_id'=>$productid,
                    'quantity'=>$this->qtyCount
                ]);
                $this->emit('cartAddedOrUpdated');
                $this->dispatchBrowserEvent('message', [
                    'text' => "product added to cart",
                    'type'=>'success',
                    'status'=>200            
                ]);
            }
            else {
                $this->dispatchBrowserEvent('message', [
                    'text' => "product does not exists",
                    'type'=>'warning',
                    'status'=>401            
                ]);
            }
        }
        else{
            $this->dispatchBrowserEvent('message', [
                'text' => "please login first",
                'type'=>'error',
                'status'=>404            
            ]);
        }
    }

    public function render()
    {
        return view('livewire.frontend.product.viewproduct',['product'=>$this->product,'category'=>$this->category]);
    }
}
