@extends('layouts.admin')
@section('content') 
@if (session('message'))
<div class="alert alert-success" role="alert">
    {{ session('message') }}
</div>
@endif
    <div class="container p-2 shadow">
      <h1>View Users
        <a name="" id="" class="btn btn-primary float-end" href="{{url('admin/user/create')}}" role="button">Add User</a>
        </h1><hr/>
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">role</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                <tr class="">
                    <td scope="row">{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td> {{$user->email}} </td>
                    <td>
                            @if ($user->role_as == "1")
                                    <span class="badge rounded-pill text-bg-primary">Admin</span>
                            @else
                                    <span class="badge rounded-pill text-bg-danger">User</span>
                            @endif
                      </td>
                    <td>
                        <a name="" id="" class="btn btn-success" href="#" role="button"><i class="bi bi-pen"></i></a>
                  
                        <a name="" id="" class="btn btn-danger" href="{{url('/admin/user/delete/'.$user->id)}}" role="button" onclick="return confirm('are you sure to delete this user??')"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
                @empty
                <tr class="">
                    <td colspan="5">No user Found</td>
                </tr>
                @endforelse
              
            </tbody>
        </table>
      </div>
        </div>
@endsection