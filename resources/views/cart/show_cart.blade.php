@extends('layouts.header')

@section('content')
@if (auth()->guest() || (auth()->check() && !auth()->user()->isAdmin()))

    <h1>Mon Panier</h1>

    @if(count($carts) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Nom du produit</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($carts as $cart)
                    <tr>
                        <td>{{$cart->product->name}}</td>
                        <td>{{$cart->product->price}} €</td>
                        <td>
                            <form action="{{ route('cart.update_cart', $cart->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="_method" value="PUT">
                                <input type="number" name="amount" value="{{$cart->amount}}" min="1" max="{{$cart->product->stock}}">
                                <button type="submit" class="btn btn-primary btn-sm">Mettre à jour</button>
                            </form>
                        </td>
                        <td>{{$cart->product->price * $cart->amount}} €</td>
                        <td>
                            <form action="{{ route('cart.delete_cart', $cart->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-right">Total :</th>
                    <td>{{$carts->sum(function($cart){ return $cart->product->price * $cart->amount;})}} €</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
        <div class="text-right">
            <a href="{{ route('payment.show') }}" class="btn btn-success">Procéder au paiement</a>
        </div>
        

        {{-- <div class="text-right">
            <a href="{{ route('checkout') }}" class="btn btn-success">Passer la commande</a>
        </div> --}}
    @else
        <p>Votre panier est vide.</p>
    @endif
@endif
@endsection
