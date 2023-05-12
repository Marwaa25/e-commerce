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
        $order = Order::findOrFail($id);
    
        if (Auth::user()->id !== $order->user_id) {
            return redirect()->route('orders.index')->with('error_message', "Vous n'êtes pas autorisé à télécharger cette facture.");
        }
    
        $pdf = new Dompdf();
        $html = view('orders.invoice', compact('order'))->render();
        $pdf->loadHtml($html);
        $pdf->render();
        $pdf->stream('facture.pdf');
    }
    




    public function index_order()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error_message', 'Vous devez être connecté pour accéder à vos commandes.');
        }
    
        if (Auth::user()->isAdmin()) {
            $orders = Order::all();
            $header = 'layouts.admin';
        } else {
            $user_id = Auth::id() ?: Cookie::get('guest_user_id');
            $orders = Order::where('user_id', $user_id)->get();
            $header = 'layouts.header';
        }
    
        return view('orders.index', compact('orders', 'header'));
    }
    

    public function create()
    {
        return view('orders.create');
    }
    public function store_order(Request $request)
    {
      
        $paymentData = $request->input('payment_data');

        $order = new Order();

        $order->user_id = auth()->user()->id;
        $order->total_amount = $paymentData['amount'];
        $order->address = $paymentData['address'];
        $order->status = 'en attente';
        $order->date = now();

        $order->save();

        $order->sendEmailNotification('en attente');

        return redirect()->route('orders.index');
    }
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();

        $order->sendEmailNotification($request->input('status'));

        return redirect()->route('orders.index')->with('success_message', 'Le statut de la commande a été modifié avec succès.');
    }

}
