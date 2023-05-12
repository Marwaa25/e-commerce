<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Carbon\Carbon;


class ClientController extends Controller
{
    public function dashboard()
    {
        
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->get();
        $orders = auth()->user()->orders()->where('status', 'pending')->get();
        $months = $orders->groupBy(function($order) {
            return Carbon::parse($order->created_at)->format('M Y');
        })->keys();
        $totals = $orders->groupBy(function($order) {
            return Carbon::parse($order->created_at)->format('M Y');
        })->map(function($orders) {
            return $orders->sum('amount');
        })->values();

        return view('client_dashboard', compact('orders','user','months','totals'));
    }
}
