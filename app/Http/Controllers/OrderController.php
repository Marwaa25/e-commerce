<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderStatusUpdate;
use Dompdf\Dompdf;
use PDF;




class OrderController extends Controller
{
    public function download_invoice($id)
    {
        // Récupérer la commande correspondante à l'ID donné
        $order = Order::findOrFail($id);
    
        // Vérifier si l'utilisateur connecté est le propriétaire de la commande
        if (Auth::user()->id !== $order->user_id) {
            return redirect()->route('orders.index')->with('error_message', "Vous n'êtes pas autorisé à télécharger cette facture.");
        }
    
        // Générer le contenu du PDF à partir des informations de la commande
        $pdf = new Dompdf();
        $html = view('orders.invoice', compact('order'))->render();
        $pdf->loadHtml($html);
    
        // Générer le PDF
        $pdf->render();
    
        // Télécharger le PDF en réponse à la requête du client
        $pdf->stream('facture.pdf');
    }
    




    public function index_order()
    {
     // Vérifier si l'utilisateur est connecté
     if (!Auth::check()) {
        return redirect()->route('login')->with('error_message', 'Vous devez être connecté pour accéder à vos commandes.');
    }

    // Vérifier si l'utilisateur est un admin
    if (Auth::user()->isAdmin()) {
        // Si l'utilisateur est un admin, récupérer toutes les commandes
        $orders = Order::all();
    } else {
        // Si l'utilisateur n'est pas un admin, récupérer seulement ses commandes
        $user_id = Auth::id() ?: Cookie::get('guest_user_id');
        $orders = Order::where('user_id', $user_id)->get();
    }

    return view('orders.index', compact('orders'));
}

    public function create()
    {
        return view('orders.create');
    }
    public function store_order(Request $request)
    {
      
        // Récupérez les données du paiement à partir de la requête
        $paymentData = $request->input('payment_data');

        // Créez une nouvelle instance du modèle Order
        $order = new Order();

        // Définissez les attributs de la commande en utilisant les données du paiement
        $order->user_id = auth()->user()->id;
        $order->total_amount = $paymentData['amount'];
        $order->address = $paymentData['address'];
        $order->status = 'en attente';
        $order->date = now();

        // Enregistrez la commande en base de données
        $order->save();

        // Appel de la méthode d'envoi de notification par email
        $order->sendEmailNotification('en attente');

        // Affichez la vue orders.index pour afficher toutes les commandes, y compris la nouvelle commande que vous venez de créer
        return redirect()->route('orders.index');
    }
    public function edit($id)
    {
        // Récupérer la commande correspondante à l'ID donné
        $order = Order::findOrFail($id);

        // Afficher la vue d'édition de la commande
        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        // Récupérer la commande correspondante à l'ID donné
        $order = Order::findOrFail($id);

        // Modifier le statut de la commande avec la valeur reçue depuis le formulaire
        $order->status = $request->input('status');
        $order->save();

        // Appel de la méthode d'envoi de notification par email
        $order->sendEmailNotification($request->input('status'));

        // Rediriger vers la page de liste des commandes avec un message de confirmation
        return redirect()->route('orders.index')->with('success_message', 'Le statut de la commande a été modifié avec succès.');
    }

}
