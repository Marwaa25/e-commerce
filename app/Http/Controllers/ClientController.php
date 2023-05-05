<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function dashboard()
{
    // $user = Auth::user();
    // $orders = $user->orders;
    // $products = $user->favoriteProducts;
    return view('client_dashboard');
}
}
