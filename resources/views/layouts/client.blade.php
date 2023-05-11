<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
</head>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" aria-current="page" href="{{ route('client_dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('products') ? 'active' : '' }}" href="{{ route('products.index_product') }}">Produits</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('orders') ? 'active' : '' }}" href="{{ route('orders.index') }}">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('categories') ? 'active' : '' }}" href="{{ route('categories.index') }}">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('cart') ? 'active' : '' }}" href="{{ route('cart.show_cart') }}">Panier</a>
                    </li>
                    <li class="nav-item">

                        <a class="nav-link {{ request()->routeIs('client_dashboard') ? 'active' : '' }}" aria-current="page" href="{{ route('client_dashboard') }}">Mon compte</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</header>
<body>
 
    @yield('content')

</body>
</html>
