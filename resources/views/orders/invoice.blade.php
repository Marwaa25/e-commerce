<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Facture</title>
</head>
<body>
    <h1>Facture</h1>
    <p>L'id du client : {{ $order->user_id }}</p>
    <p>Total de la commande : {{ $order->amount }}</p>
    <p>Date de la commande : {{ $order->created_at }}</p>
</body>
</html>
