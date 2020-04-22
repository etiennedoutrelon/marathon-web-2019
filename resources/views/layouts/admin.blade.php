<html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Administration - @yield('title')</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">

    <style>
        html, body {
            color: #636b6f;
            font-family: 'Nunito', sans-serif !important;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }
    </style>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/mdb.min.css')}}" rel="stylesheet">
</head>

<body class="grey lighten-3">

<!--Main Navigation-->
<header>

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
        <div class="container-fluid">

            <!-- Brand -->
            <a class="navbar-brand waves-effect" href="{{route('admin')}}">
                <strong class="teal-text">Reviews Panel Admin</strong>
            </a>
            <a class="navbar-item nav-link waves-effect" href="{{route('admin.members')}}">
                <strong class="teal-text">Gestion des utilisateurs</strong>
            </a>

            <!-- Collapse -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


        </div>
        <!-- Collapsible content -->
        @if (Route::has('login'))
            <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                <ul class="navbar-nav ml-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link teal-text waves-effect" href="{{route('home')}}">Website
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect" id="navbarDropdownMenuLink-4" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user"></i> {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-4">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();"> {{ __('Déconnexion') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endauth
                </ul>
            </div>
        @endif
    </nav>
    <!-- Navbar -->

</header>


<!--Main layout-->
<main class="pt-5 mx-lg-5" style="margin-bottom: 8%;">
    <div class="container-fluid mt-5">
        <!-- Heading -->
        <div class="card mb-4 wow fadeIn">

            <!--Card content-->
            <div class="card-body d-sm-flex justify-content-between">

                <h4 class="mb-2 mb-sm-0 pt-1">
                    <a href="{{route('admin')}}" style="color: teal;">Administration</a>
                    <span>/</span>
                    <span>@yield('title')</span>
                </h4>

            </div>

        </div>
        <!-- Heading -->
        @yield('content')
    </div>
</main>

@section('footer')
    @include('layouts.footer')
@show

<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/mdb.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/popper.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/addons/jquery.zmd.hierarchical-display.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/addons/directives.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/addons/flag.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/addons/imagesloaded.pkgd.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/addons/masonry.pkgd.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/modules/animations-extended.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/modules/forms-free.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/modules/scrolling-navbar.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/modules/treeview.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/modules/wow.min.js') }}"></script>
</body>
</html>
