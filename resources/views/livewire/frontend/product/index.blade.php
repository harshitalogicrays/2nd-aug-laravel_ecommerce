<div class="py-3 py-md-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-4">Our Products</h4>
            </div>
        <div class="row">
        <div class="col-2">
            <div class="card">
                <div class="card-header">Filter using Price</div>
                <div class="card-body">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="priceSort" id="" value="high-to-low" wire:model="priceInput">
                      <label class="form-check-label" for="" >
                       High to Low
                      </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="priceSort" id="" value='low-to-high' wire:model="priceInput">
                        <label class="form-check-label" for="" >
                         Low to High
                        </label>
                      </div>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="priceSort" id="" value="above1000" wire:model="priceInput">
                    <label class="form-check-label" for="" >
                     > 1000
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="priceSort" id="" value="above3000" wire:model="priceInput">
                    <label class="form-check-label" for="" >
                    > 3000
                    </label>
                  </div>
            </div>
        </div>
        <div class="col-10">
            <div class="row">
                @forelse ($products as $pro)
                <div class="col-md-3">
                 <div class="product-card">
                     <div class="product-card-img">
                         @if ($pro->qty > 0)
                             <label class="stock bg-success">In Stock</label>
                         @else
                             <label class="stock bg-danger">Out of Stock</label>
                         @endif
                         @if ($pro->productImages()->count() > 0)
                         <a href="{{url('collection/'.$category->name . '/'.$pro->name)}}">
                            <img src="{{asset($pro->productImages[0]->image)}}" alt="Laptop" height='180x'>
                         </a>
                                  @endif
                        
                     </div>
                     <div class="product-card-body">
                         <p class="product-brand">{{$pro->brand}}</p>
                         <h5 class="product-name">
                            <a href="">
                             {{$pro->name}}
                            </a>
                         </h5>
                         <div>
                             <span class="selling-price">${{$pro->selling_price}}</span>
                             <span class="original-price">${{$pro->originial_price}}</span>
                         </div>
                     </div>
                 </div>
             </div>
                @empty
                    <h1>No Product Found for {{$category->name}}</h1>
                @endforelse 
            
             </div>
            
        </div>
        </div>


        </div>
    </div>
</div>