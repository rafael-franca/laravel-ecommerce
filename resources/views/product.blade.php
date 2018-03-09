@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <img class="card-img-top" src="{{ $product->image }}" alt="{{ $product->title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->title }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">US$ {{ number_format($product->price, 2, '.', ',') }}</h6>
                    <p class="card-text">{{ $product->description }}</p>
                    <p class="card-text"><small class="text-muted">Code: {{ $product->barcode }}</small></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
