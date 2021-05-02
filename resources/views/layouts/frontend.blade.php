<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TessCrimeRS') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/db163c922e.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <link href="{{ asset('toastr/toastr.min.css') }}" rel="stylesheet">
</head>
<body class="front-bg">
    <div id="app">
        <nav class="js-navbar" style="background: #fff">
            <a href="{{ url('/') }}" class="js-nav-logo text-primary">
                {{ config('app.name', 'Laravel') }}
            </a>
            <ul class="js-nav-menu">
                @guest
                    <li class="js-nav-item">
                        <a href="{{ route('login') }}" class="js-nav-link">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="js-nav-item">
                            <a href="{{ route('register') }}" class="js-nav-link">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="js-nav-item">
                        <a href="{{ route('incident.index') }}" class="js-nav-link">Incidents</a>
                    </li>

                    <li class="js-nav-item">
                        <span class="online"></span><a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();" class="js-nav-link">{{ Auth::user()->name }}</a>
                        <span>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}

                            </a>
                        </span>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>


                    {{-- <li class="js-nav-item js-dropdown">
                        <a href="javascript:void(0)" class="js-nav-link js-dropbtn" onclick="myFunction()">
                            {{ Auth::user()->name }} <span class="fa fa-sign-out"></span>
                        </a>

                        <div class="js-dropdown-content" id="myDropdown">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}

                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li> --}}

                @endguest

                <li class="js-nav-item show-menu">
                    <a href="{{ route('news') }}" class="js-nav-link">News/Info</a>
                </li>

            </ul>
            <div class="js-hamburger">
                <span class="js-bar"></span>
                <span class="js-bar"></span>
                <span class="js-bar"></span>
            </div>
        </nav>
        {{-- <div class="languages">
            @foreach(config()->get('app.locales') as $code => $lang)
                <a href="http://{{$code}}.laravel.test">{{ $lang }}</a>
            @endforeach
        </div> --}}
        
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script src="{{ asset('toastr/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>


    <x-notifications />
</body>
</html>
