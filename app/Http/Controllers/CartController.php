<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Cookie;


class CartController extends Controller
{
  
    public function add_to_cart(Request $request, $id)
    {
        $product = Product::find($id);
        $user_id = auth()->id() ?: Cookie::get('guest_user_id');
        
        if (Auth::check()) {
            $guest_user_id = Cookie::get('guest_user_id');
            $guest_carts = Cart::where('user_id', $guest_user_id)->get();
        
            foreach ($guest_carts as $cart) {
                $cart->user_id = Auth::id();
                $cart->save();
            }

            Cookie::queue(Cookie::forget('guest_user_id'));
        }
        
        if (!$product) {
            return back()->withErrors(['message' => 'Product not found']);
        }
        
        if (!$user_id) {
            $user_id = rand(1, 100);
            
            Cookie::queue('guest_user_id', $user_id, 60 * 24 * 7); // Set the cookie value
        }
        
        $cart = Cart::where('product_id', $product->id)
                    ->where('user_id', $user_id)
                    ->first();
    
        if ($cart) {
            $cart->increment('amount', $request->amount);
        } else {
            $cart = new Cart([
                'product_id' => $product->id,
                'user_id' => $user_id,
                'amount' => $request->amount,
            ]);
            $cart->save();
        }
    
        return redirect()->route('cart.show_cart')->with('success', 'Product added to cart successfully');
    }
    
    public function show_cart()
    {
        $user_id = Auth::id() ?: Cookie::get('guest_user_id');
        $carts = Cart::where('user_id', $user_id)->get();
    
        return view('cart.show_cart', [
            'carts' => $carts,
        ]);
    }
    
    // public function edit_cart(Cart $cart)
    // {
    //     return view('cart.edit_cart', [
    //         'cart' => $cart,
    //     ]);
    // }
    
    public function update_cart(Cart $cart, Request $request)
    {
        $cart->update(['amount' => $request->input('amount')]);

    
        return redirect()->route('cart.show_cart');
    }
    
    

    public function delete_cart(Cart $cart)
    {
        $cart->delete();
        return Redirect::route('cart.show_cart');
    }
}
