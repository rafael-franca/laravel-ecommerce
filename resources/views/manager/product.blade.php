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

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <img class="card-img-top" src="{{ $product->image }}" alt="{{ $product->title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->title }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        US$ {{ number_format($product->price, 2, '.', ',') }}
                        @can('drafts', App\Product::class)
                        ({{ ($product->published) ? 'Published' : 'Draft' }})
                        @endcan
                    </h6>
                    <p class="card-text">{{ $product->description }}</p>
                    <p class="card-text"><small class="text-muted">Code: {{ $product->barcode }}</small></p>
                    @can('update', $product)
                    <a class="btn btn-primary" href="{{ route('manager.edit_product', ['product' => $product->id]) }}">Edit</a>
                    @endcan
                    @can('delete', $product)
                    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteProduct">Delete</button>
                    <div class="modal fade" id="deleteProduct" tabindex="-1" role="dialog" aria-labelledby="deleteProduct" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <form action="{{ route('manager.delete_product', ['product' => $product->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Delete Product</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this product?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-secondary" data-dismiss="modal">No, I want cancel!</button>
                                        <button type="submit" class="btn btn-danger">Yes, delete it!</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
