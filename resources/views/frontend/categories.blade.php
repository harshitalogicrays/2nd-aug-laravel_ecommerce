@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row">
        @forelse ($categories as $c)
        <div class="card col-3 m-2">
            <a href="{{url('/collections/'.$c->name)}}">
            <img class="card-img-top" src="{{asset($c->image)}}" height='200px' alt="Title"> </a>
            <div class="card-body">
                <h4 class="card-title">{{$c->name}}</h4>
                <p class="card-text">{{$c->description}}</p>
            </div>
        </div>
        @empty
            <h1>No Category Found</h1>
        @endforelse
        
    </div>
</div>
@endsection