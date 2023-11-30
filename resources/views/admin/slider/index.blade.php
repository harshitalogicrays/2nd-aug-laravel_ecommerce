@extends('layouts.admin')
@section('content') 
@if (session('message'))
<div class="alert alert-success" role="alert">
    {{ session('message') }}
</div>
@endif
    <div class="container p-2 shadow">
      <h1>View Slider
        <a name="" id="" class="btn btn-primary float-end" href="{{url('admin/slider/create')}}" role="button">Add Slider</a>
        </h1><hr/>
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Image</th>
                    <th scope="col">status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sliders as $s)
                <tr class="">
                    <td scope="row">{{$s->id}}</td>
                    <td>{{$s->title}}</td>
                    <td><img src="{{asset($s->image)}}" style="width:50px;height:50px">
                      </td>
                    <td>
                        @if ($s->status=='0')
                            <span class="badge rounded-pill text-bg-primary">Active</span>
                        @else
                        <span class="badge rounded-pill text-bg-danger">Inactive</span>
                        @endif
                      </td>
                </tr>
                @empty
                <tr class="">
                    <td colspan="5">No Slider Found</td>
                </tr>
                @endforelse
              
            </tbody>
        </table>
      </div>
      {{$sliders->links('pagination::bootstrap-5')}}
    </div>
@endsection