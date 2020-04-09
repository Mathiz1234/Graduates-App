<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, shrink-to-fit=no" />
        <title>@yield('title', __('general.graduate'))</title>
        <meta name="description" content="@lang('general.des')"/>
        <meta name="keywords" content="@lang('general.keywords')"/>
        <meta http-equiv="X-UA-Compatibile" content="IE=edge,chrome=1"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicon/apple-icon-57x57.png')}}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicon/apple-icon-60x60.png')}}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicon/apple-icon-72x72.png')}}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon/apple-icon-76x76.png')}}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicon/apple-icon-114x114.png')}}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicon/apple-icon-120x120.png')}}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicon/apple-icon-144x144.png')}}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicon/apple-icon-152x152.png')}}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-icon-180x180.png')}}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('favicon/android-icon-192x192.png')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png')}}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon/favicon-96x96.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png')}}">
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png')}}">
        <meta name="theme-color" content="#ffffff">


        <link rel= "stylesheet" href= "{{ asset('css/app.css') }}" type="text/css"/>

    </head>
    <body>

      <nav id="main-menu" class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="{{ route('main') }}">
              <i class="fas fa-user-graduate d-inline-block align-text-bottom mr-1"></i>
              @lang('general.graduate')</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
              <li class="nav-item @isset($page) @if( $page == 'main' ) active @endif @endisset">
                  <a class="nav-link" href="{{ route('main') }}"><i class="fas fa-home mr-1"></i>@lang('general.home') @isset($page) @if( $page == 'main' ) <span class="sr-only">@lang('general.here')</span> @endif @endisset</a>
                </li>
                <li class="nav-item @isset($page) @if( $page == 'search' ) active @endif @endisset">
                <a class="nav-link" href="{{route('graduates.index')}}"><i class="fas fa-search mr-1"></i>@lang('general.search') @isset($page) @if( $page == 'search' ) <span class="sr-only">@lang('general.here')</span> @endif @endisset</a>
                </li>
                <li class="nav-item @isset($page) @if( $page == 'rules' ) active @endif @endisset">
                    <a class="nav-link" href="{{ route('rules') }}"><i class="fas fa-file-alt mr-1"></i>@lang('general.rules') @isset($page) @if( $page == 'rules' ) <span class="sr-only">@lang('general.here')</span> @endif @endisset</a>
                  </li>
              </ul>
              @if (Route::has('login'))
                <div class="ml-auto">
                    @auth
                        <div class="btn-group">
                            <button type="button" class="btn btn-outline-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              @lang('general.account')
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg-right" style="z-index: 10000;">
                            <a class="dropdown-item" href="{{ url('account') }}">@lang('general.profile')</a>
                              @if(auth()->user()->isAdmin())
                              <a class="dropdown-item" href="{{ url('account/management') }}">@lang('general.menagement')</a>
                              @endif
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        @lang('general.logout')
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                            </div>
                          </div>
                    @else
                        <a class="btn btn-outline-success my-2 my-sm-0" href="{{ route('login') }}">{{ __('Login') }}</a>

                        @if (Route::has('register'))
                            <a class="btn btn-outline-success my-2 my-sm-0"href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    @endauth
                      @if(app()->getLocale() == 'pl')
                        <a href="{{ url('language') }}"><img width="30" height="30" src="{{ asset('svg/language/en.svg') }}" alt="English flag"></a>
                      @else
                        <a href="{{ url('language') }}"><img width="30" height="30" src="{{ asset('svg/language/pl.svg') }}" alt="Poland flag"></a>
                      @endif
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
            <p class="text-muted m-0"><i class="mr-2 fas fa-copyright"></i>{{ __('Graduate system 2019 All rights reserved. Author: ') }} <a data-toggle="tooltip" data-html="true" title="<em> {{ __('Contact email:') }} mateusz.sutor.contact@gmail.com </em>"> Mateusz Sutor </a> <a href="{{route('rules')}}" target="_blank">@lang('general.rules')</a></p>
            </div>
         </div>
        </footer>

        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

    </body>
</html>