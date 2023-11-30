@extends('layouts.admin')
@section('content') 
@if (session('message'))
<div class="alert alert-success" role="alert">
    {{ session('message') }}
</div>
@endif
    <div class="container p-2 shadow">
      <h1>View Category
        <a name="" id="" class="btn btn-primary float-end" href="{{url('admin/category/create')}}" role="button">Add Category</a>
        </h1><hr/>
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $c)
                <tr class="">
                    <td scope="row">{{$c->id}}</td>
                    <td>{{$c->name}}</td>
                    <td><img src="{{asset($c->image)}}" style="width:50px;height:50px">
                      </td>
                    <td>
                        @if ($c->status=='1')
                            <span class="badge rounded-pill text-bg-primary">Active</span>
                        @else
                        <span class="badge rounded-pill text-bg-danger">Inactive</span>
                        @endif
                      </td>
                    <td>
                        <a name="" id="" class="btn btn-success"  href="{{url('admin/category/edit/'.$c->id)}}" role="button">Edit</a>
                        <a name="" id="" class="btn btn-danger" href="{{url('admin/category/delete/'.$c->id)}}" role="button" onclick="return confirm('are you sure to delete this??')">Delete</a>
                    </td>
                </tr>
                @empty
                <tr class="">
                    <td colspan="5">No category Found</td>
                </tr>
                @endforelse
              
            </tbody>
        </table>
      </div>
      {{$categories->links('pagination::bootstrap-5')}}
    </div>
@endsection