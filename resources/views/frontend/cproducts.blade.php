@extends('layouts.app')

@section('content')
    <livewire:frontend.product.index :products="$products" :category="$category"/>
@endsection