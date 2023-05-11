@extends('layouts.header')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $product->name }}</div>
            <div class="card-body">
                <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded" width="200px">
                <p>{{ $product->description }}</p>
                <p class="font-weight-bold">Prix: {{ $product->price }} €</p>
                <p>Catégorie: {{ $product->category->name }}</p>
                @if (!Auth::user()->isAdmin())

                <form method="POST" action="{{ route('cart.add_to_cart', $product->id) }}">
                    @csrf
                    <div class="form-group">
                        <label for="amount">Amount:</label>
                        <input type="number" class="form-control" id="amount" name="amount" min="1" max="{{ $product->stock }}" value="1">
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('Add to Cart') }}</button>
                </form>
                @endif
                <!-- Si vous souhaitez afficher la quantité en stock -->
                <!-- <p>Stock: {{ $product->stock }}</p> -->
                @if (Auth::user()->isAdmin())

                <a href="{{ route('products.edit_product', ['product' => $product->id]) }}" class="btn btn-primary">Editer</a>

                <form method="POST" action="{{ route('products.destroy_product', $product) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{__("Effacer")}}</button>
                </form>
                @endif
                
            </div>
        </div>
    </div>
</div>
</div>
@endsection
