<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonte do Google -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

        <!-- CSS Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

        <!-- CSS da aplicação -->
        <link rel="stylesheet" href="/css/styles.css">
        <script src="/js/scripts.js"></script>
    </head>
    <body>
      <header>
        <nav class="navbar navbar-expand-lg navbar-light">
          <div class="collapse navbar-collapse" id="navbar">
            <a href="/" class="navbar-brand">
              <img src="/img/hdcauctions_logo.svg" alt="HDC Auction">
            </a>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a href="/" class="nav-link">Leilões</a>
              </li>
              <li class="nav-item">
                <a href="/auctions/create" class="nav-link">Cadastrar Carro</a>
              </li>
              <li class="nav-item">
                <a href="/auctions/create/auction" class="nav-link">Cadastrar Leilão</a>
              </li>
              @auth
              <li class="nav-item">
                <a href="/dashboard" class="nav-link">Meus leilões</a>
              </li>
              <li class="nav-item">
                <form action="/logout" method="POST">
                  @csrf
                  <a href="/logout" 
                    class="nav-link" 
                    onclick="auction.preventDefault();
                    this.closest('form').submit();">
                    Sair
                  </a>
                </form>
              </li>
              @endauth
              @guest
              <li class="nav-item">
                <a href="/login" class="nav-link">Entrar</a>
              </li>
              <li class="nav-item">
                <a href="/register" class="nav-link">Cadastrar</a>
              </li>
              @endguest
            </ul>
          </div>
        </nav>
      </header>
      <main>
        <div class="container-fluid">
          <div class="row">
            @if(session('msg'))
              <p class="msg">{{ session('msg') }}</p>
            @endif
            @yield('content')
          </div>
        </div>
      </main>
      <footer>
        <p>Corretagem - Leilões &copy; 2024</p>
      </footer>
      <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
    </body>
</html>