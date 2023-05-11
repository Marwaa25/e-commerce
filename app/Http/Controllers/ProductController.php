<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Imports\ProductImport;
use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;


class ProductController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth')->except('index', 'show');
    // }

   
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv,txt'
        ]);
    
        $file = $request->file('file')->store('import');
    
        $import = new ProductImport;
        $import->import($file);
    
        if ($import->failures()->isNotEmpty()) {
            Storage::delete($file);
            return back()->withFailures($import->failures());
        }
    
        Storage::delete($file);
    
        return redirect()->route('products.index_product')->with('success', 'Les produits ont été importés avec succès.');
    }
    
    public function export()
    {
        return Excel::download(new ProductExport, 'products.xlsx');
    }
    public function index_product()
    {
        // Determine the header layout based on the user's role
        if (Auth::user()->isAdmin()) {
            $header = 'layouts.admin';
        } else {
            $header = 'layouts.header';
        }
    
        // Get the products to display
        $products = Product::orderBy('created_at', 'desc')->paginate(12);
    
        return view('products.index_product', compact('products', 'header'));
    }
    
    public function index()
    {
        
        $products = Product::orderBy('created_at', 'desc')->paginate(12);
        return view('products.index', compact('products'));
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
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = new Product();

        $product->name = $validatedData['name'];
        $product->price = $validatedData['price'];
        $product->stock = $validatedData['stock'];
        $product->description = $validatedData['description'];
        $product->category_id = $validatedData['category_id'];
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $filename);
            $product->image = $filename;
        }

        $product->save();
    
        return redirect('/products')->with('success', 'Le produit a été ajouté avec succès');
    }
    

    public function show_product(Product $product)
    {
        
        return view('products.show_product', compact('product'));
    }

    public function edit_product(Product $product)
{
    $categories = Category::all();
    return view('products.edit_product', compact('product', 'categories'));
}

public function update_product(Request $request, Product $product)
{
    $validatedData = $request->validate([
        'name' => 'required',
        'price' => 'required',
        'stock' => 'required',
        'description' => 'required',
        'category_id' => 'required|exists:categories,id',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $product->name = $validatedData['name'];
    $product->price = $validatedData['price'];
    $product->stock = $validatedData['stock'];
    $product->description = $validatedData['description'];
    $product->category_id = $validatedData['category_id'];

    if ($request->hasFile('image')) {
        // Suppression de l'ancienne image
        $old_image_path = public_path('images/') . $product->image;
        if (File::exists($old_image_path)) {
            File::delete($old_image_path);
        }

        // Enregistrement de la nouvelle image
        $image = $request->file('image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $filename);
        $product->image = $filename;
    }

    $product->save();

    return redirect()->route('products.show_product', $product)->with('success', 'Le produit a été modifié avec succès.');
}


    public function destroy_product(Product $product)
    {
        
    
        // Suppression du produit
        $product->delete();
    
        // Redirection vers la liste des produits avec un message de succès
        return redirect()->route('products.index_product')->with('success', 'Le produit a été supprimé avec succès.');
    }
}    