<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Slider;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index(){
       $sliders= Slider::where('status','0')->get();
        return view('frontend.index',compact('sliders'));
    }
    public function collection(){
        $categories=Category::where('status','1')->get();
        return view('frontend.categories',compact('categories'));
    }
    public function cproducts($category){
       $category = Category::where('name',$category)->first();
       if($category){
        $products=$category->products()->get();
        return view('frontend.cproducts',compact('products','category'));
       }
        else{return redirect()->back();}
    }

    public function viewproduct($category,$product){
        $category=Category::where('name',$category)->first();
        if($category){
            $product=$category->products()->where('name',$product)->where('status','0')->first();
            if($product){
                return view('frontend.viewproducts',compact('product','category'));
            }
            else{
                return redirect()->back();
            }
        }
    }
    public function searchproducts(Request $request){
        if($request->search !=null){
           $searchdata=Product::where('name','LIKE','%'.$request->search."%")->orWhere('brand','LIKE','%'.$request->search."%")->latest()->paginate(5);
           return view('frontend.searchproducts',compact('searchdata'));
        }
        else{
            $searchdata=Product::paginate(5);
            return view('frontend.searchproducts',compact('searchdata'));
        }
    }
}
