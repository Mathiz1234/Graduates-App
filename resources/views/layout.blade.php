<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Absolwenci</title>
        <meta name="description" content="Wyszukaj absolwenta swojej szkoły!"/>
        <meta name="keywords" content="absolwent, absolwenci, szkoła, dane, ukończenie, system, tabele, spis uczniów, uczniowie, uczeń"/>
        <meta http-equiv="X-UA-Compatibile" content="IE=edge,chrome=1"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel= "stylesheet" href= "{{ asset('css/app.css') }}" type="text/css"/>

    </head>
    <body>

      <nav id="main-menu" class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="{{ route('main') }}">
              <i class="fas fa-user-graduate d-inline-block align-text-bottom mr-1"></i>
              ABSOLWENCI</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
              <li class="nav-item @isset($page) @if( $page == 'main' ) active @endif @endisset">
                  <a class="nav-link" href="{{ route('main') }}"><i class="fas fa-home mr-1"></i>Strona główna @isset($page) @if( $page == 'main' ) <span class="sr-only">(tu jesteś)</span> @endif @endisset</a>
                </li>
                <li class="nav-item @isset($page) @if( $page == 'search' ) active @endif @endisset">
                <a class="nav-link" href="{{route('graduates.index')}}"><i class="fas fa-search mr-1"></i>Przeszukaj @isset($page) @if( $page == 'search' ) <span class="sr-only">(tu jesteś)</span> @endif @endisset</a>
                </li>
                <li class="nav-item @isset($page) @if( $page == 'rules' ) active @endif @endisset">
                    <a class="nav-link" href="{{ route('rules') }}"><i class="fas fa-file-alt mr-1"></i>Regulamin @isset($page) @if( $page == 'rules' ) <span class="sr-only">(tu jesteś)</span> @endif @endisset</a>
                  </li>
              </ul>
              @if (Route::has('login'))
                <div class="ml-auto">
                    @auth
                        <div class="btn-group">
                            <button type="button" class="btn btn-outline-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Konto
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg-right">
                              <a class="dropdown-item" href="#">Mój profil</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Wyloguj się
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                            </div>
                          </div>
                    @else
                        <a class="btn btn-outline-success my-2 my-sm-0" href="{{ route('login') }}">Zaloguj się</a>

                        @if (Route::has('register'))
                            <a class="btn btn-outline-success my-2 my-sm-0"href="{{ route('register') }}">Zarejestuj się</a>
                        @endif
                    @endauth
                </div>
            @endif
            </div>
        </nav>

        <main>

          <div class="container">
            @yield('content')
          </div>

        </main>

        <section>
          <a href="#main-menu" id="btn-go-up" class="btn btn-primary btn-lg btn-circle"><i class="fas fa-arrow-up"></i></a>
        </section>

        <footer>
          <div class="footer mt-auto py-3 border shadow-sm">
            <div class="container text-center">
              <p class="text-muted m-0"><i class="mr-2 fas fa-user-graduate"></i>System absolwentów. &copy 2019 Wszelkie prawa zastrzeżone. Autor: Mateusz Sutor <a href="{{route('rules')}}" target="_blank">Regulamin</a></p>
            </div>
         </div>
        </footer>

        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

    </body>
</html>