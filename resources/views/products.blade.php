@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="card-columns">
            @foreach ($products as $product)
            <div class="card">
                <img class="card-img-top" src="{{ $product->image }}" alt="{{ $product->title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->title }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">US$ {{ number_format($product->price, 2, '.', ',') }}</h6>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="{{ route('show_product', ['slug' => $product->slug]) }}" class="btn btn-primary">See more</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="row justify-content-center my-3">
        {{ $products->links() }}
    </div>
</div>
@endsection
