@extends('layouts.header')

@section('content')
    <h1>Paiement de la commande</h1>

    <form action="{{ route('payment.process') }}" method="POST">
@csrf

<div>
    <label for="name">Nom :</label>
    <input type="text" id="name" name="name" required>
</div>

<div>
    <label for="email">Adresse e-mail :</label>
    <input type="email" id="email" name="email" required>
</div>

<button type="submit">Proceder au paiement</button>
</form>