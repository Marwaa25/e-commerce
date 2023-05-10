<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Facture</title>
</head>
<body>
    <h1>Facture</h1>
    <p>Nom du client : {{ $order->customer_name }}</p>
    <p>Adresse de livraison : {{ $order->delivery_address }}</p>
    <p>Total de la commande : {{ $order->total }}</p>
    <p>Date de la commande : {{ $order->created_at }}</p>
</body>
</html>
