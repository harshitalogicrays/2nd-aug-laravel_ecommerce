@extends('layouts.admin')
@section('content')
@if (session('message'))
<div class="alert alert-success" role="alert">
    {{ session('message') }}
</div>
@endif
<div class="container mt-5 p-3 shadow">
    <h1>Orders</h1> <hr/>
    <form method="get">
        <div class="row mb-3">
            <div class="col-4">
                <label>Filter By Date</label><br/>
                <input type="date" class="form-control" name="date"
                value="{{Request::get('date')?? date('Y-m-d')}}">
            </div>
            <div class="col-4">
                <label>Filter by status</label>
                    <select class="form-select form-select-lg" name="status">
                        <option>Select All status</option>
                        <option {{Request::get('status')=='in progress' ? 'selected':''}}>in progress</option>
                        <option {{Request::get('status')=='completed' ? 'selected':''}}>completed</option>
                        <option {{Request::get('status')=='cancelled' ? 'selected':''}}>cancelled</option>
                        <option {{Request::get('status')=='shipped' ? 'selected':''}}>shipped</option>
                        <option {{Request::get('status')=='processing' ? 'selected':''}}>processing</option>
                        <option {{Request::get('status')=='delivered' ? 'selected':''}}>delivered</option>                     
                    </select>
            </div>
            <div class="col-4 mt-3">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">tracking_no</th>
                    <th scope="col">Username</th>
                    <th>Payment Mode</th>
                    <th>Order Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                <tr class="">
                    <td scope="row">{{$order->id}}</td>
                    <td>{{$order->tracking_no}}</td>
                    <td>{{$order->fullname}}</td>
                    <td>{{$order->payment_mode}}</td>
                    <td>{{$order->created_at->format('d-m-Y')}}</td>
                    <td>{{$order->status_message}}</td>
                    <td>
                        <a type="button" class="btn btn-primary" href="{{url('/admin/orders/view/'.$order->id)}}">View</a>
                    </td>
                </tr>
                @empty
                    <tr><td colspan="7">No order found</td></tr>
                @endforelse
               
            </tbody>
        </table>
        {{$orders->links('pagination::bootstrap-5')}}
    </div>
    
</div>
@endsection