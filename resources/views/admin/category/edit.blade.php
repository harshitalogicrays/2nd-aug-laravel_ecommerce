@extends('layouts.admin')
@section('content') 
@if (session('message'))
<div class="alert alert-success" role="alert">
    {{ session('message') }}
</div>
@endif
<div class="container p-2 shadow">
    <h1>Update  Category<a name="" id="" class="btn btn-danger float-end" href="{{url('admin/category')}}" role="button">Back</a></h1> <hr/>
    <form enctype="multipart/form-data" method="post" action="{{url('admin/category/update/'.$category->id)}}">
        @csrf
        <div class="mb-3">
          <label for="" class="form-label">Name</label>
          <input type="text" name="name"  class="form-control" value="{{$category->name}}">
          @error('name')
          <small id="helpId" class="text-danger">{{$message}}</small>
       @enderror
      
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Image</label>
            <input type="file" name="image"  class="form-control">
          </div>
          @if ($category->image)
          <img src="{{asset($category->image)}}" class="mb-3" style="height: 80px;width:100px"/>
          @endif
        
          <div class="form-group">         
            <label class="form-check-label" for="">
               Status
            </label>
            <input class="form-check-input" type="checkbox" name="status" value="1" {{$category->status=='1' ? "checked":''}}>
          </div>
          <div class="mb-3">
            <label for="" class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="3">{{$category->description}}</textarea>
          </div>
          <button type="submit" class="btn btn-primary">Update Category</button>
    </form>
</div>
@endsection