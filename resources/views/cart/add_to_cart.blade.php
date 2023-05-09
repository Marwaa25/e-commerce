{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add to Cart</h1>
        <form method="post" action="{{ route('cart.store') }}">
            @csrf
            <div class="form-group">
                <label for="product_id">Product:</label>
                <select class="form-control" id="product_id" name="product_id">
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }} - ${{ $product->price }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" class="form-control" id="quantity" name="quantity" min="1" value="1">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Add to Cart</button>
        </form>
    </div>
@endsection --}}
