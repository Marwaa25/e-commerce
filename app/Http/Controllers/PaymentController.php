<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Models\Cart;

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
        $amount = $request->input('amount');
        if (Auth::check()) {
            // Récupérer les produits du panier de l'utilisateur temporaire
            $guest_user_id = Cookie::get('guest_user_id');
            $guest_carts = Cart::where('user_id', $guest_user_id)->get();
        
            // Mettre à jour les produits du panier avec l'ID de l'utilisateur authentifié
            foreach ($guest_carts as $cart) {
                $cart->user_id = Auth::id();
                $cart->save();
            }
        
            // Supprimer l'ID de l'utilisateur temporaire
            Cookie::queue(Cookie::forget('guest_user_id'));
        }
        

        try {
            $charge = Charge::create([
                'amount' => $amount,
                'currency' => 'eur',
                'description' => 'Paiement de commande',
                'source' => $token,
            ]);

            // Mettre à jour la commande ici

            return redirect()->route('products.index_product')->with('success_message', 'Le paiement a été effectué avec succès.');
        } catch (\Stripe\Error\Card $e) {
            return redirect()->route('payment.show')->with('error_message', 'Une erreur est survenue lors du paiement : ' . $e->getMessage());
        }
    }
}
