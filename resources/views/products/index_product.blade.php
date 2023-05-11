@extends($header)

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @if (Auth::user()->isAdmin())

                <div>
                    <div class="text-right mb-3">
                        <a href="{{ route('products.export') }}" class="btn btn-primary">
                            Exporter les produits
                        </a>
                        <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="file">Fichier CSV</label>
                                <input type="file" name="file" class="form-control-file @error('file') is-invalid @enderror" id="file">
                                @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                            <button type="submit" class="btn btn-primary">Importer</button>
                        </form>
                        
                        
                        
                    </div>
                </div>
                @endif
                    <h1>Products List</h1>
                    @livewire('products-list')
                </div>
                

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
