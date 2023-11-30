@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
           <div class="card">
            <div class="card-header">
                <h3>
                    Add Product
                    <a name="" id="" class="btn btn-danger text-white float-end" href="{{url('admin/products')}}" role="button">Back</a>
                </h3>
            </div>
            <div class="card-body">
                <form method="post" action="{{url('admin/product')}}" enctype="multipart/form-data">
                    @csrf
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
                                                <option selected disabled>select</option>
                                                @foreach ($categories as $c)
                                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                            <span class="text-danger">{{$message}}</span>
                                           @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Name</label>
                                            <input type="text" name="name" id="" class="form-control"
                                                placeholder="" aria-describedby="helpId">
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Brand</label>
                                            <input type="text" name="brand" id="" class="form-control"
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
                                            <input type="number" name="originial_price" id="" class="form-control"
                                                placeholder="" aria-describedby="helpId">
                                        </div>
                                    <div class="mb-3">
                                            <label for="" class="form-label">selling_price</label>
                                            <input type="number" name="selling_price" id="" class="form-control"
                                                placeholder="" aria-describedby="helpId">
                                        </div>
                                      
                                        <div class="mb-3">
                                            <label for="" class="form-label">Quantity</label>
                                            <input type="number" name="qty" id="" class="form-control"
                                                placeholder="" >
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Description</label>
                                            <textarea  name="description" id="" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-check-label" for="">
                                                Status
                                              </label>
                                          <input class="form-check-input" type="checkbox"   name="status">
                                         
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