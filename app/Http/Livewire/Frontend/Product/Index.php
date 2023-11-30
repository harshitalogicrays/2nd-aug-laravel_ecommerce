<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Product;
use Livewire\Component;

class Index extends Component
{   public $products,$category;
    public $priceInput;
    protected $queryString=['priceInput'=>['except'=>'','as'=>'price']];
    public function mount($products,$category){
        $this->products=$products;
        $this->category=$category;
    }
    public function render()
    {
        // return view('livewire.frontend.product.index',['products'=>$this->products]);

        $this->products=Product::where('category_id',$this->category->id)
                        ->when($this->priceInput,function($q){
                            $q->when($this->priceInput=="high-to-low",function($q1){
                                $q1->orderBy("selling_price","DESC");
                            })->when($this->priceInput=="low-to-high",function($q1){
                                $q1->orderBy("selling_price","ASC");
                            })->when($this->priceInput=="above1000",function($q1){
                                $q1->where("selling_price", ">","1000")->where("selling_price", "<=","3000");
                            })->when($this->priceInput=="above3000",function($q1){
                                $q1->where("selling_price", ">","3000");
                            });
                        })->where('status','0')->get();
                return view('livewire.frontend.product.index',['products'=>$this->products,'category'=>$this->category]);


    }
}
