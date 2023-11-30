@extends('layouts.app')
@section('content')
<div class="py-3 py-md-5 bg-light">
    <div class="container">
        <div class="row">
            @forelse ($searchdata as $product)
            <div class="col-md-3">
                <div class="product-card">
                    <div class="product-card-img">
                        @if ($product->qty>0)
                            <label class="stock bg-success">In stock</label>
                        @else
                            <label class="stock bg-danger">Out of Stock</label>    
                        @endif
                        @if ($product->productImages->count()>0)
                        <img src="{{asset($product->productImages[0]->image)}}" alt="{{$product->name}}" height='200px'>      
                        @endif
                      
                    </div>
                    <div class="product-card-body">
                        <p class="product-brand">{{$product->brand}}</p>
                        <h5 class="product-name">
                           <a href="{{url('/collections/'.$product->category->name.'/'.$product->name )}}">
                            {{$product->name}}
                           </a>
                        </h5>
                        <div>
                            <span class="selling-price">${{$product->selling_price}}</span>
                            <span class="original-price">${{$product->originial_price}}</span>
                        </div>
                    </div>
                </div>
            </div>     
            @empty
                <div class="col-12">
                    <div class="p-2">
                        <h4>No products found</h4>
                    </div>
                </div>
            @endforelse


                
        </div>
    </div>
</div>
{{$searchdata->links('pagination::bootstrap-5')}}
@endsection