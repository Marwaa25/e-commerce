@extends('layouts.header')

@section('content')
    <div class="container">
        <h2>Modifier un produit</h2>
        <hr>
        <form method="POST" action="{{ route('products.update_product', $product->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nom:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" required>
            </div>
            <div class="form-group">
                <label for="price">Prix:</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" required>
            </div>
            <div class="form-group">
                <label for="stock">Stock:</label>
                <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="5" required>{{ old('description', $product->description) }}</textarea>
            </div>
            <div class="form-group">
                <label for="category_id">Catégorie:</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if($product->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control-file" id="image" name="image">
                @if($product->image)
                    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="img-thumbnail mt-2" style="max-width: 200px;">
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        </form>
    </div>
@endsection
