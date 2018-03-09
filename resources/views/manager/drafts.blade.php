@extends('manager.layouts.app')

@section('content')
<div class="container">
    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
    
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex mb-3">
        <ul class="nav mr-auto">
            <li>
                <a class="btn btn-link" href="{{ route('manager.list_products') }}" role="button">Published</a>
            </li>
            <li>
                @can('drafts', App\Product::class)
                <a class="btn btn-primary" href="{{ route('manager.list_drafts') }}" role="button">Drafts</a>
                @endcan
            </li>
        </ul>
        @can('create', App\Product::class)
        <a class="btn btn-primary" href="{{ route('manager.create_product') }}" role="button">+ New Product</a>
        @endcan
    </div>
    <div class="row">
        <div class="card-columns">
            @foreach ($products as $product)
            <div class="card">
                <img class="card-img-top" src="{{ $product->image }}" alt="{{ $product->title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->title }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">US$ {{ number_format($product->price, 2, '.', ',') }}</h6>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="{{ route('manager.show_product', ['product' => $product->id]) }}" class="btn btn-primary">See more</a>
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
