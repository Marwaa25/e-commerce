<div>
    <form>
        <div>
            <label>Search:</label>
            <input type="text" wire:model="search">
            {{-- <button type="button" wire:click="search" class="btn btn-primary">{{ __('Search') }}</button> --}}


        </div>
        <div>
            <label>Category:</label>
            <select wire:model="category">
                <option value="">All</option>
                <option value="1">Electronics</option>
                <option value="2">Clothing</option>
                <option value="3">Books</option>
            </select>            
        </div>
    </form>
    <div>
        <div class="row">
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
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                {{ $products->links() }}
            </div>
        </div>        
    </div>
 
</div>
