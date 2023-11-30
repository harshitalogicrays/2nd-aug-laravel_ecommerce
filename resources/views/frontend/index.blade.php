@extends('layouts.app')

@section('content')
<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach ($sliders as $key=>$s)
        <div class="carousel-item  {{$key=='0' ? 'active':null}}">
            <img src="{{$s->image}}" class="d-block w-100" height='230px' alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>{{$s->title}}</h5>
                <p>{{$s->description}}</p>
              </div>
          </div>

        @endforeach
    
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
@endsection