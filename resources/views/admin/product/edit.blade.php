@extends('layouts.admin')
@section('content')
@if (session('message'))
<div class="alert alert-success" role="alert">
    {{ session('message') }}
</div>
@endif
    <div class="row">
        <div class="col-md-12">
           <div class="card">
            <div class="card-header">
                <h3>
                    Edit Product
                    <a name="" id="" class="btn btn-danger text-white float-end" href="{{url('admin/products')}}" role="button">Back</a>
                </h3>
            </div>
            <div class="card-body">
 <form method="post" action="{{url('/admin/product/update/'.$product->id)}}" enctype="multipart/form-data">
   @csrf
   @method('PUT')
  <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#home-tab-pane" type="button" role="tab"
                                    aria-controls="home-tab-pane" aria-selected="true">Home</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="details-tab" data-bs-toggle="tab"
                                    data-bs-target="#details-tab-pane" type="button" role="tab"
                                    aria-controls="details-tab-pane" aria-selected="false">Details</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="image-tab" data-bs-toggle="tab"
                                    data-bs-target="#image-tab-pane" type="button" role="tab"
                                    aria-controls="image-tab-pane" aria-selected="false">Image</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                                aria-labelledby="home-tab" tabindex="0">
                                <div class="card mt-3">
                                    <div class="card-body">
       <div class="mb-3">
         <label for="" class="form-label">Category</label>
         <select name="category_id" class="form-select">
          <option>select</option>
           @foreach ($categories as $c)
             <option value="{{ $c->id }}" {{$product->category_id==$c->id  ?"selected":null}}>{{ $c->name }}</option>
             @endforeach
           </select>
               @error('category_id')
               <span class="text-danger">{{$message}}</span>
              @enderror
                                           
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Name</label>
                                            <input type="text" name="name" id="" class="form-control" value="{{$product->name}}"
                                                placeholder="" aria-describedby="helpId">
                                                @error('name')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Brand</label>
                                            <input type="text" name="brand" id="" class="form-control"  value="{{$product->brand}}"
                                                placeholder="">
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                                <div class="tab-pane fade" id="details-tab-pane" role="tabpanel"
                                    aria-labelledby="details-tab" tabindex="0">
                                    <div class="card mt-3">
                                        <div class="card-body">
                                          <div class="mb-3">
                                            <label for="" class="form-label">originial_price</label>
                                            <input type="number" name="originial_price" id="" class="form-control"  value="{{$product->originial_price}}"
                                                placeholder="" aria-describedby="helpId">
                                                @error('originial_price')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                        </div>
                                    <div class="mb-3">
                                            <label for="" class="form-label">selling_price</label>
                                            <input type="number" name="selling_price" id="" class="form-control"
                                                placeholder=""   value="{{$product->selling_price}}"aria-describedby="helpId">
                                                @error('selling_price')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                        </div>
                                      
                                        <div class="mb-3">
                                            <label for="" class="form-label">Quantity</label>
                                            <input type="number" name="qty" id="" class="form-control"
                                                placeholder=""  value="{{$product->qty}}">
                                                @error('qty')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Description</label>
                                            <textarea  name="description" id="" class="form-control">{{$product->description}}</textarea>
                                        </div>
                                        <div class="form-check">
                                          <input class="form-check-input" type="checkbox"   name="status"   {{$product->status=='0'?"checked":null}}>
                                          <label class="form-check-label" for=""
                                        >
                                            Status
                                          </label>
                                        </div>
                                  </div>
                                </div>
                                    </div>
                                <div class="tab-pane fade" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab"
                                    tabindex="0">
                                    <div class="card mt-2">
                                      <div class="card-body">
                                        <div class="mb-3">
                                          <label for="" class="form-label">upload product images</label>
                                          <input type="file" class="form-control" multiple  name="image[]" id="" placeholder="" aria-describedby="fileHelpId">
                                        </div>
                                      <div>
                                        @if ($product->productImages)
                                            @foreach ($product->productImages as  $images)
                                               <img src="{{asset($images->image)}}"  width="100px" height="100px" class="mb-2" border="2">
                                               <a href="{{url('admin/product-image/delete/'.$images->id)}}" style="position: relative;top:-50px;left:-5px">X</a>
                                            @endforeach
                                        @else
                                            <h1>No Image Found</h1>
                                        @endif


                                      </div> 
                                        <input name="save" id="" class="btn btn-primary" type="submit" value="Save">
                                      </div>
                                    </div>
                                        
                                </div>
                                   
                            </div>
                       
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection