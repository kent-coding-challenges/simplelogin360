<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Site -->
    <title>
        {{ config('app.name') }}
    </title>
    <link rel="shortcut icon" href="{{ asset('favicon.gif') }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="main-navbar navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('smlogo.gif') }}" />
                        <span class="text">
                            {{ config('app.name') }}
                        </span>
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    @if (Auth::user())
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="{{ route('home') }}">
                                    <i class="material-icons">home</i>
                                    <span class="text">
                                        Home
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('users.index') }}">
                                    <i class="material-icons">person</i>
                                    <span class="text">
                                        Users
                                    </span>
                                </a>
                            </li>
                        </ul>
                    @endif

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li>
                                <a href="{{ route('login') }}">
                                    <span class="text">
                                        Login
                                    </span>
                                </a>
                            </li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <span class="text">
                                        Hi {{ Auth::user()->first_name }}
                                    </span>
                                    <i class="material-icons arrow">arrow_drop_down</i>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/libs/snackbar.js') }}"></script>

    @include('global.notification')
</html>