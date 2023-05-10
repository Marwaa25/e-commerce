@extends('layouts.header')

@section('content')
    <div class="container">
        <h1>Modifier la commande #{{ $order->id }}</h1>
        <form action="{{ route('orders.update', ['order' => $order->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="status">Statut :</label>
                <select name="status" id="status" class="form-control">
                    <option value="en attente" @if ($order->status === 'en attente') selected @endif>En attente</option>
                    <option value="en préparation" @if ($order->status === 'en préparation') selected @endif>En préparation</option>
                    <option value="expédié" @if ($order->status === 'expédié') selected @endif>Expédié</option>
                    <option value="livré" @if ($order->status === 'livré') selected @endif>Livré</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
@endsection
