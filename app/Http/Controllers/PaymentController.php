<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Models\Cart;
use App\Models\Order;

class PaymentController extends Controller
{
    public function show()
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login')->with('error_message', 'Vous devez être connecté pour accéder à la page de paiement.');
        }

        // Si l'utilisateur est connecté, récupérer les produits dans son panier
        $user_id = Auth::id() ?: Cookie::get('guest_user_id');
        $carts = Cart::where('user_id', $user_id)->get();
        $total = $carts->sum(function($cart){ 
            return $cart->product->price * $cart->amount;
        });
        return view('payment.show', compact('total', 'carts'));
    }

    public function process(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $token = $request->input('stripeToken');
        $amount = floatval($request->input('amount')) * 100; // Stripe nécessite que le montant soit en centimes
        $user_id = Auth::id() ?: Cookie::get('guest_user_id');

        try {
            $charge = Charge::create([
                'amount' => $amount,
                'currency' => 'eur',
                'description' => 'Paiement de commande',
                'source' => $token,
            ]);

            // Créer la commande
            $order = new Order([
                'user_id' => $user_id,
                'amount' => $amount
            ]);
            $order->save();
            
            // Attach the products to the order
            $carts = Cart::where('user_id', $user_id)->get();
            foreach ($carts as $cart) {
                $order->products()->attach($cart->product_id, ['quantity' => $cart->amount]);
            }
            

            // Vider le panier de l'utilisateur
            $carts->each->delete();

            return redirect()->route('orders.index')->with('success_message', 'Le paiement a été effectué avec succès. Votre commande a été enregistrée.');
        } catch (\Stripe\Error\Card $e) {
            return redirect()->route('payment.show')->with('error_message', 'Une erreur est survenue lors du paiement : ' . $e->getMessage());
        }
    }
}
