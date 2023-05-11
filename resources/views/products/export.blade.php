@extends('layouts.header')
@section('content')
    <div class="container">
        <h1>Importer des produits</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="file">Fichier Excel</label>
                <input type="file" name="file" class="form-control-file @error('file') is-invalid @enderror" id="file">
                @error('file')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">
                Importer les produits
            </button>
        </form>
        
    </div>
@endsection
