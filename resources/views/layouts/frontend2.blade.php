<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="https://kit.fontawesome.com/db163c922e.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <link href="{{ asset('toastr/toastr.min.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        {{-- Customer navbar --}}
        <div class="js-header">
            <x-user-nav />
        </div>


        {{-- <main class="py-4">
            @yield('content')
        </main> --}}

        <div class="container py-4 navbar-space">
            <div class="row">
                {{-- @if (Auth::check() && Auth::user()->role) --}}

                <div class="col-md-8">
                    @yield('content')
                </div>

                <div class="col-md-4">
                    <x-sidebar />
                </div>
                {{-- @else
                    <div class="col-md-12">
                        @yield('content')
                    </div>
                @endif --}}


            </div>
        </div>
    </div>

    <script src="{{ asset('toastr/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <x-notifications />
</body>

</html>
