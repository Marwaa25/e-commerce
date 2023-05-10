<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mise à jour du statut de commande</title>
</head>
<body>
    <h1>Mise à jour du statut de votre commande</h1>
    <p>Bonjour ,</p>
    <p>Votre commande  a été mise à jour et est maintenant dans l'état suivant : {{ $orderDetails['status'] }}.</p>
    {{-- <p>Voici le récapitulatif de votre commande :</p> --}}
    
    {{-- <ul>
        @foreach ($orderDetails['products'] as $product)
            <li>{{ $product['name'] }} - {{ $product['quantity'] }} x {{ $product['price'] }} €</li>
        @endforeach
    </ul> --}}
    {{-- <p>Le montant total de votre commande est de {{ $orderDetails['amount'] }} €.</p> --}}
    <p>Merci pour votre achat !</p>
</body>
</html>
