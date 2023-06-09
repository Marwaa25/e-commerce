<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PaymentController;
use \App\Http\Controllers\OrderController;
use App\Http\Livewire\ProductsList;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/







Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


 


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth','admin'])->group(function () {
        // Route for admin dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard');
        // Gestion des produits
    // Route::get('/products', \App\Http\Livewire\ProductsList::class)->name('products.list');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/add', [ProductController::class, 'create_product'])->name('products.create_product');
    Route::post('/products/store', [ProductController::class, 'store_product'])->name('products.store_product');
    Route::get('/products/edit/{product}', [ProductController::class, 'edit_product'])->name('products.edit_product');
    Route::put('/products/update/{product}', [ProductController::class, 'update_product'])->name('products.update_product');
    Route::delete('/products/{product}', [ProductController::class, 'destroy_product'])->name('products.destroy_product');
        // Route pour la gestion des clients 
    Route::get('/clients', [AdminController::class, 'index'])->name('clients.index');
    Route::get('/clients/{client}', [AdminController::class, 'show'])->name('clients.show');
    Route::get('/clients/create', [AdminController::class, 'create'])->name('clients.create');
    Route::post('/clients', [AdminController::class, 'store'])->name('clients.store');
    // Route::get('/clients/{id}/edit', [AdminController::class, 'edit'])->name('clients.edit');
    // Route::put('/clients/{id}', [AdminController::class, 'update'])->name('clients.update');
    Route::delete('/clients/{id}', [AdminController::class, 'destroy'])->name('clients.destroy');

        //Route pour les importantions et les exportations
    Route::get('/products/export', [ProductController::class, 'export'])->name('products.export');
    Route::post('/products/import', [ProductController::class, 'import'])->name('products.import');




        //Route pour la gestion des commandes    
    Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
    Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy_order'])->name('orders.destroy_order');
        
        // Route pour la gestion des catégories
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});
Route::middleware(['auth','client'])->group(function () {
        // Route for client dashboard
    Route::get('/client/dashboard', [ClientController::class, 'dashboard'])->name('client_dashboard');

        // Route pour le paiement
    Route::get('/paiement', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/paiement', [PaymentController::class, 'process'])->name('payment.process');
});


    //Route pour les produits (tout le monde)
    
Route::get('/', [ProductController::class, 'index_product'])->name('products.index_product');
Route::get('/products/show/{product}', [ProductController::class, 'show_product'])->name('products.show_product');

    // Route pour le panier
Route::get('/cart', [CartController::class, 'show_cart'])->name('cart.show_cart');
Route::post('/cart/add/{product}', [CartController::class, 'add_to_cart'])->name('cart.add_to_cart');
// Route::get('/cart/{cart}/edit', [CartController::class, 'edit_cart'])->name('cart.edit_cart');
Route::put('/cart/{cart}', [CartController::class, 'update_cart'])->name('cart.update_cart');
Route::delete('/cart/delete/{cart}', [CartController::class, 'delete_cart'])->name('cart.delete_cart');


    // Route pour les categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

Route::get('/orders', [OrderController::class, 'index_order'])->name('orders.index');
// Route::get('/orders/create', [OrderController::class, 'create_order'])->name('orders.create_order');
// Route::post('/orders', [OrderController::class, 'store_order'])->name('orders.store_order');
Route::get('/orders/{order}', [OrderController::class, 'show_order'])->name('orders.show_order');

Route::get('orders/{id}/download-invoice', [OrderController::class, 'download_invoice'])->name('orders.download_invoice');




Route::view('/promotions', 'promotions.index')->name('promotions.index');


require __DIR__.'/auth.php';
