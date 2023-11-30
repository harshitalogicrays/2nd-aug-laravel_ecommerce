@extends('layouts.admin')
@section('content') 
@if (session('message'))
<div class="alert alert-success" role="alert">
    {{ session('message') }}
</div>
@endif
    <div class="container p-2 shadow">
      <h1>View Products
        <a name="" id="" class="btn btn-primary float-end" href="{{url('admin/product/create')}}" role="button">Add Product</a>
        </h1><hr/>
      <div class="table-responsive mb-3">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th>Category</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th>Price</th>
                    <th scope="col">status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
              @forelse ($products as $product)
                  <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->category->name}}</td>
                    <td>{{$product->name}}</td>
                    <td>
                      @if ($product->productImages()->count()>0)
                        <img src="{{asset($product->productImages[0]->image)}}">
                      @endif
                    </td>
                    <td>{{$product->originial_price}}</td>
                    <td>
                        @if ($product->status == '0')
                            <span class="badge rounded-pill text-bg-success">Active</span>
                        @else
                        <span class="badge rounded-pill text-bg-danger">Inactive</span>
                        @endif
                     </td>
                    <td>
                      <a name="" id="" class="btn btn-success btn-sm" h href="{{'product/edit/'.$product->id}}" role="button"><i class="bi bi-pen"></i></a>
                      <a name="" id="" class="btn btn-danger btn-sm" href="{{'product/delete/'.$product->id}}" role="button" onclick="return window.confirm('are you sure to delete this??')"><i class="bi bi-trash"></i></a>
                    </td>

                  </tr>
              @empty
                <tr><td colspan="6">No product found</td> </tr>
              @endforelse
            </tbody>
        </table>
      </div>
      {{$products->links('pagination::bootstrap-5')}}
    </div>
@endsection