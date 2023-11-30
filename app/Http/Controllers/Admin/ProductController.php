<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductImages;
use App\Models\Admin\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductFormRequest;

class ProductController extends Controller
{
    public function index(){
        $products=Product::paginate(3);
        return view('admin.product.index',compact('products'));
    }
    public function create(){
        $categories=Category::all();
        return view('admin.product.create',compact('categories'));
    }
    public function store(ProductFormRequest $request){
        $validatedData=$request->validated();
        $category=Category::find($validatedData['category_id']);
      $product=$category->products()->create([
        'category_id'=>$validatedData['category_id'],
        'name'=>$validatedData['name'],
        'originial_price'=>$validatedData['originial_price'],
        "selling_price"=>$validatedData['selling_price'],
        "qty"=>$validatedData['qty'],
        "brand"=>$request['brand'],
        "status"=>$request['status']==true ? '0':'1',
        "descritpion"=>$request['description']
       ]); 
    //    return $product;
    if($request->hasFile('image')){
        $uploadPath='uploads/products/';
        $i=1;
        foreach($request->file('image') as $imagefile){
            $extension=$imagefile->getClientOriginalExtension();
            $filename=time().$i++. '.'.$extension;
            $imagefile->move($uploadPath,$filename);
            $finalImagePathName=$uploadPath.$filename;

            $product->productImages()->create([
                'product_id'=>$product->id,
                'image'=>$finalImagePathName
            ]);
        }  
    }
       return redirect('/admin/products')->with('message','product added');
    }

    public function delete($id){
        $product=Product::find($id);
        if($product->productImages){
        foreach($product->productImages as $images){
            if(File::Exists($images->image)){
                File::delete($images->image);
            }
        }
    }
    $product->delete();
    return redirect('admin/products')->with('message','product deleted');
    }

    public function edit($id){
        $product=Product::find($id);
        $categories=Category::all();
        return view('admin.product.edit',compact('product','categories'));
    }

    public function update(ProductFormRequest $request,$id){
        $validatedData=$request->validated();
        $product=Product::where('id',$id)->first();
        if($product){
            $product->update([
                'category_id'=>$validatedData['category_id'],
                'name'=>$validatedData['name'],
                'originial_price'=>$validatedData['originial_price'],
                "selling_price"=>$validatedData['selling_price'],
                "qty"=>$validatedData['qty'],
                "brand"=>$request['brand'],
                "status"=>$request['status']==true ? '0':'1',
                "descritpion"=>$request['description']
            ]);
        }
       
        if($request->hasFile('image')){
            $uploadPath='uploads/products/';
            $i=1;
            foreach($request->file('image') as $imagefile){
                $extension=$imagefile->getClientOriginalExtension();
                $filename=time().$i++. '.'.$extension;
                $imagefile->move($uploadPath,$filename);
                $finalImagePathName=$uploadPath.$filename;
    
                $product->productImages()->create([
                    'product_id'=>$product->id,
                    'image'=>$finalImagePathName
                ]);
            }  
        }
           return redirect('/admin/products')->with('message','product updated');
    
    }

    public function destroy($id){
        $productimage=ProductImages::find($id);
        if(File::Exists($productimage->image)){
            File::delete($productimage->image);
        }
        $productimage->delete();
        return redirect()->back()->with('message','image deleted');
    }
    }
   
