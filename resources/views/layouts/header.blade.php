<!DOCTYPE html>
<html lang="en">
{{-- <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

</head> --}}
<header>
    @livewireStyles
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="/">
          <img src="/images/logo.png" alt="Logo" width="150">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="/">Accueil</a>
            </li>
            <li class="nav-item dropdown">
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
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Promotions</a>
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