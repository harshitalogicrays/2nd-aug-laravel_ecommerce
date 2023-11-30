
@extends('layouts.app')
@section('content')
    <div class="container py-5">
        @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            {{session('message')}}

        </div>            
    @endif
        <div class="row justify-content-center">
                <div class="col-10">
                    <div class="card shadow">
                        <div class="card-header bg-primary">
                            <h4 class="text-white mb-0">User Profile
                                <a name="" id="" class="btn btn-danger float-end" href="{{url('change_password')}}" role="button">Change Password</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="{{url('profile')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                          <label for="" class="form-label">Username</label>
                                          <input type="text" name="name" value="{{Auth::user()->name}}" id="" class="form-control" placeholder="">
                                          @error('name')
                                          <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                  
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                          <label for="" class="form-label">Email</label>
                                          <input type="text" name="email" value="{{Auth::user()->email}}" readonly id="" class="form-control" placeholder="" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                          <label for="" class="form-label">Phone Number</label>
                                          <input type="text" name="phone" id="" class="form-control" placeholder="" value="{{Auth::user()->userDetail->phone ?? ''}}">
                                          @error('phone')
                                          <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                  
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                          <label for="" class="form-label">Pincode</label>
                                          <input type="text" name="pincode" id="" class="form-control" placeholder="" value="{{Auth::user()->userDetail->pincode ?? ''}}">
                                          @error('pincode')
                                          <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                  
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                  <label for="" class="form-label">Address</label>
                                  <textarea class="form-control" name="address" id="" rows="3">{{Auth::user()->userDetail->address ?? ''}}</textarea>
                                  @error('address')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          
                                </div>
                                <div class="d-grid gap-2">
                                  <button type="submit" name="" id="" class="btn btn-primary">Save Data</button>
                                </div>
                            </form>

                        </div>

                    </div>
                    

                </div>

        </div>
    </div>
@endsection