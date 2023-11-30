@extends('layouts.app')

@section('content')
    <livewire:frontend.product.viewproduct :product="$product" :category="$category"/>
@endsection