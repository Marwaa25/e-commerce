<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">

<!-- JavaScript Bundle with Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>

    <title>Document</title>

</head>
<header>
    @livewireStyles
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="/">
          <img src="/images/logo.jpg" alt="Logo" width="90">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('products.index_product')}}">Accueil</a>
            </li>
            {{-- <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Catégories
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="#">Soins du visage</a></li>
                <li><a class="dropdown-item" href="#">Soins du corps</a></li>
                <li><a class="dropdown-item" href="#">Compléments alimentaires</a></li>
                <li><a class="dropdown-item" href="#">Hygiène bucco-dentaire</a></li>
                <li><a class="dropdown-item" href="#">Santé</a></li>
              </ul>
            </li> --}}
            
            <li class="nav-item">
              <a class="nav-link" href="{{route('promotions.index')}}">Promotions</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('cart.show_cart')}}">
                <i class="bi bi-cart"></i>
                Panier
              </a>
            </li>
            <li class="nav-item">

            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" aria-current="page" href="{{ route('client_dashboard') }}">Mon compte</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  
<body>
    @yield('content')
        
    @livewireScripts
</body>
</html>