{{-- @extends('layouts.app')

@section('content') --}}
    <div class="container">
        <h1>Mettre à jour la quantité du produit "{{ $cart->product->name }}"</h1>
        <form action="{{ route('update_cart', ['cart' => $cart->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="amount">Quantité</label>
                <input type="number" name="amount" id="amount" class="form-control" value="{{ old('amount', $cart->amount) }}" min="1" max="{{ $cart->product->stock }}">
                @error('amount')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
{{-- @endsection --}}
