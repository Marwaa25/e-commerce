<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductsList extends Component
{
    public $search = '';
    public $category = '';

  public function render()
{
    $products = Product::query();

    if (!empty($this->search)) {
        $products = $products->where('name', 'like', '%' . $this->search . '%');
    }
    if (!empty($this->minPrice)) {
        $products = $products->where('price', '>=', $this->minPrice);
    }
    
    if (!empty($this->maxPrice)) {
        $products = $products->where('price', '<=', $this->maxPrice);
    }
    

    if (!empty($this->category)) {
        $products = $products->where('category_id', $this->category);
    }

    $products = $products->paginate(9);

    return view('livewire.products-list', compact('products'));
}

}
