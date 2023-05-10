<div>
    <form>
        <div class="form-group">
            <label for="search">Search:</label>
            <input type="text" class="form-control" id="search" wire:model="search">
        </div>
        <div class="form-group">
            <label for="category">Category:</label>
            <select class="form-control" id="category" wire:model="category">
                <option value="">All</option>
                <option value="1">Soin de la peau</option>
                <option value="2">Soin de cheveux</option>
                <option value="3">Soin des lèvres</option>
                <option value="4">Soin des mains</option>
            </select>            
        </div>
    </form>
    <div>
        <div class="row">
            @foreach($products as $product)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <a href="{{ route('products.show_product', $product->id) }}">
                        <img src="{{ asset('images/'.$product->image) }}" class="card-img-top" alt="{{ $product->name }}" height="200">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text"><strong>{{ $product->price }} €</strong></p>
                        <form method="POST" action="{{ route('cart.add_to_cart', $product->id) }}">
                            @csrf
                            <div class="form-group">
                                <label for="amount">Amount:</label>
                                <input type="number" class="form-control" id="amount" name="amount" min="1" max="{{ $product->stock }}" value="1">
                            </div>
                            <button type="submit" class="btn btn-primary">{{ __('Add to Cart') }}</button>
                        </form>
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
    </div>
</div>
 
</div>
