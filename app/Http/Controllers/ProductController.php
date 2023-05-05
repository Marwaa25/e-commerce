<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth')->except('index', 'show');
    // }

    public function index_product()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(12);
        return view('products.index_product', compact('products'));
    }

    public function create_product()
    {
        $categories = Category::all();
        $product = new Product(); // create an empty product object
        return view('products.create_product', compact('categories', 'product'));
    }
    

    public function store_product(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'stock' => 'required|integer|min:0'
        ]);

        $imageName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->storeAs('images', $imageName, 'public');
        

        $product = new Product;
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];
        $product->category_id = $validatedData['category_id'];
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/images/'), $filename);
            $product->image = $filename;
        }        $product->stock = $validatedData['stock'];
        // $product->user_id = Auth::id();
        $product->save();

        return redirect('/products')->with('success', 'Le produit a été ajouté avec succès');
    }

    public function show_product(Product $product)
    {
        return view('products.show_product', compact('product'));
    }

    public function edit_product(Product $product)
    {
        return view('products.edit_product', compact('product'));
    }

    public function update_product(Product $product, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'description' => 'required',
            'image' => 'required'
        ]);

        $file = $request->file('image');
        $path = time() . '_' . $request->name . '.' . $file->getClientOriginalExtension();

        Storage::disk('local')->put('public/' . $path, file_get_contents($file));

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'image' => $path,
        ]);

        return Redirect::route('products.show_product', $product);
    }

    public function destroy_product(Product $product)
    {
        // Vérification de l'autorisation de supprimer le produit
        // $this->authorize('delete', $product);
    
        // Suppression du produit
        $product->delete();
    
        // Redirection vers la liste des produits avec un message de succès
        return redirect()->route('products.index_product')->with('success', 'Le produit a été supprimé avec succès.');
    }
}    