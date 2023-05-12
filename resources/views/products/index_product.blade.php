@extends($header)

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @if (auth()->check() && auth()->user()->isAdmin())
            <div>
                <div class="text-right mb-3">
                    <a href="{{ route('products.export') }}" class="btn btn-primary">
                        Exporter les produits
                    </a>
                    <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="file">Fichier CSV</label>
                            <div class="input-group">
                                <input type="file" name="file" class="form-control-file @error('file') is-invalid @enderror" id="file">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Importer</button>
                                </div>
                            </div>
                            @error('file')
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </form>
                </div>
                <a href="{{ route('products.create_product') }}" class="btn btn-primary">Ajouter un produit</a>

            </div>
            @endif
            <div class="card-body">
                <h1 class="mb-4">Products List</h1>
                @livewire('products-list')
            </div>

        </div>

        <div class="card mt-4">
            <div class="card-body">
                {{-- <div class="row">
                    @foreach($products as $product)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <img src="{{ asset('storage/images/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" height="200">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ $product->description }}</p>
                                <p class="card-text"><strong>{{ $product->price }} €</strong></p>
                                <p class="card-text">{{ $product->category->name }}</p>
                                <a href="{{ route('products.show_product', $product->id) }}" class="btn btn-primary">{{ __('View') }}</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div> --}}
                {{-- <div class="row mt-4">
                    <div class="col-md-12">
                        {{ $products->links() }}
                    </div>
                </div> --}}
            </div>
        </div>

    </div>
</div>
</div>
@livewireScripts
@livewireStyles
@endsection

