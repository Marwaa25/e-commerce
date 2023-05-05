{{-- @extends('layouts.app')

@section('content') --}}
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Ajouter un produit</h2>
                <form action="{{ route('products.store_product') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nom du produit:</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Prix:</label>
                        <input type="number" step="0.01" class="form-control" name="price" id="price" value="{{ old('price') }}">
                        @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="category">Catégorie:</label>
                        <select class="form-control" name="category_id" id="category">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if (old('category_id') == $category->id) selected @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">Image:</label>
                        <input type="file" class="form-control-file" name="image" id="image">
                        @if ($product->image)
                            <img src="{{ asset('storage/images/' . $product->image) }}" alt="Product Image" style="max-width: 200px; max-height: 200px;">
                        @endif
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="stock">Stock:</label>
                        <input type="number" class="form-control" name="stock" id="stock" value="{{ old('stock') }}">
                        @error('stock')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
{{-- @endsection --}}
