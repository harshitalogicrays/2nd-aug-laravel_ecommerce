@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="me-md-3 me-xl-5">
                        <h2>
                            @if (session('message'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('message') }}
                                </div>
                            @endif
                        </h2>
                        <h2>Dashboard</h2>
                        <p class="mb-md-0">Your analytics dashboard template.</p>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row mb-3">
                <div class="col-3">
                    <div class="card card-body bg-primary text-white text-center">
                        <label>Total Orders</label>
                        <h1>{{ $ordercount }}</h1>
                        <a name="" id="" class="btn text-white btn-warning" href="{{ url('/admin/orders') }}"
                            role="button">View</a>
                    </div>
                </div>

                <div class="col-3">
                    <div class="card card-body bg-success text-white text-center">
                        <label>Todays Orders</label>
                        <h1>{{ $todaysorder }}</h1>
                        <a name="" id="" class="btn text-white btn-danger" href="{{ url('/admin/orders') }}"
                            role="button">View</a>
                    </div>
                </div>

                <div class="col-3">
                    <div class="card card-body bg-warning text-white text-center">
                        <label>This month Orders</label>
                        <h1>{{ $thismonthorder }}</h1>
                        <a name="" id="" class="btn  text-white btn-info" href="{{ url('/admin/orders') }}"
                            role="button">View</a>
                    </div>
                </div>

                <div class="col-3">
                    <div class="card card-body bg-danger text-white text-center">
                        <label>This Year Orders</label>
                        <h1>{{ $thisyearorder }}</h1>
                        <a name="" id="" class="btn  text-white btn-primary" href="{{ url('/admin/orders') }}"
                            role="button">View</a>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-3">
                    <div class="card card-body bg-primary text-white text-center">
                        <label>Total Products</label>
                        <h1>{{ $productcount }}</h1>
                        <a name="" id="" class="btn  text-white btn-secondary" href="{{ url('/admin/products') }}"
                            role="button">View</a>
                    </div>
                </div>

                <div class="col-3">
                    <div class="card card-body bg-success text-white text-center">
                        <label>Total Categories</label>
                        <h1>{{ $totalcategories }}</h1>
                        <a name="" id="" class="btn text-white btn-warning" href="{{ url('/admin/category') }}"
                            role="button">View</a>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-3">
                    <div class="card card-body bg-primary text-white text-center">
                        <label>All Users</label>
                        <h1>{{ $totalAllUsers }}</h1>
                        <a name="" id="" class="btn  text-white btn-danger" href="{{ url('/admin/users') }}"
                            role="button">View</a>
                    </div>
                </div>

                <div class="col-3">
                    <div class="card card-body bg-success text-white text-center">
                        <label>Total Users</label>
                        <h1>{{ $totalUser }}</h1>
                        <a name="" id="" class="btn  text-white btn-dark" href="{{ url('/admin/users') }}"
                            role="button">View</a>
                    </div>
                </div>

                <div class="col-3">
                    <div class="card card-body bg-warning text-white text-center">
                        <label>Total Admin</label>
                        <h1>{{ $totalAdmin }}</h1>
                        <a name="" id="" class="btn text-white btn-primary" href="{{ url('/admin/users') }}"
                            role="button">View</a>
                    </div>
                </div>
            </div>
        </div>
    @endsection

