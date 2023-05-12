<div class="container mt-3">
    <form>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2" wire:model="search">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button" id="button-addon2">Go</button>
                    </div>
                </div>
            </div>
            <div class="col-md-2 mb-3">
                <input type="number" class="form-control" placeholder="Min Price" aria-label="Min Price" min="0" wire:model="minPrice">
            </div>
            <div class="col-md-2 mb-3">
                <input type="number" class="form-control" placeholder="Max Price" aria-label="Max Price" min="0" wire:model="maxPrice">
            </div>
            <div class="col-md-2 mb-3">
                <select class="form-control" id="category" wire:model="category">
                    <option value="">All</option>
                    <option value="1">Soin de la peau</option>
                    <option value="2">Soin de cheveux</option>
                    <option value="3">Soin des lèvres</option>
                    <option value="4">Soin des mains</option>
                </select> 
            </div>
        </div>
    </form>
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-3 mb-3">
            <div class="card h-100">
                <a href="{{ route('products.show_product', $product->id) }}">
                    <img src="{{ asset('images/'.$product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                </a>
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text"><strong>{{ $product->price }} €</strong></p>
                    @if (auth()->guest() || (auth()->check() && !auth()->user()->isAdmin()))
                    <form method="POST" action="{{ route('cart.add_to_cart', $product->id) }}">
                        @csrf
                        <div class="form-group">
                            <label for="amount">Amount:</label>
                            <input type="number" class="form-control" id="amount" name="amount" min="1" max="{{ $product->stock }}" value="1">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Add to Cart') }}</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            {{ $products->links('pagination::simple-bootstrap-4') }}
        </div>
    </div>    