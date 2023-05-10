{{-- @extends('layouts.app')

@section('content') --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $product->name }}</div>

                <div class="card-body">
                    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" width="200px">
                    <p>{{ $product->description }}</p>
                    <p>Prix: {{ $product->price }} €</p>
                    <p>Catégorie: {{ $product->category->name }}</p>
                    <!-- Si vous souhaitez afficher la quantité en stock -->
                    <!-- <p>Stock: {{ $product->stock }}</p> -->
                    <a href="{{ route('products.edit_product', ['product' => $product->id]) }}" class="btn btn-primary">Editer</a>

                    <form method="POST" action="{{ route('products.destroy_product', $product) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="submit-btn">{{__("Effacer")}}</button>
                    </form>
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @endsection --}}
