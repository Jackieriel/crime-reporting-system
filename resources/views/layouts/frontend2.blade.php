<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Scripts -->
    <script src="{{ secure_asset('js/app.js') }}" defer></script>

    <script src="https://kit.fontawesome.com/db163c922e.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('css/components.min.css') }}" rel="stylesheet">

    <link href="{{ secure_asset('toastr/toastr.min.css') }}" rel="stylesheet">

    <script src="{{ secure_asset('js/Chart.min.js') }}"></script>
    
</head>

<body>

    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                includedLanguages: 'en,ha,ig,fr',                
            }, 'google_translate_element');
        }

    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>


    <div id="app">
        {{-- Customer navbar --}}
        <div class="js-header">
            <x-user-nav />
        </div>

        <div class="container py-4 navbar-space">
            <div class="row">
                {{-- @if (Auth::check() && Auth::user()->role) --}}

                <div class="col-md-8">
                    @yield('content')
                </div>

                <div class="col-md-4">
                    <x-sidebar />
                </div>


            </div>
        </div>
    </div>


    <!-- Loader -->
  <div id="loader-wrapper">
    <div id="loader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
  </div>

  <!-- end loader -->

  <script>
    // Loader

    document.onreadystatechange = function () {
      if (document.readyState !== "complete") {
        document.querySelector(
          "#app").style.visibility = "hidden";
        document.querySelector(
          "#loader-wrapper").style.visibility = "visible";
      } else {
        document.querySelector(
          "#loader-wrapper").style.display = "none";
        document.querySelector(
          "#app").style.visibility = "visible";
      }
    };



// Loader
  </script>
  

    <script src="{{ secure_asset('toastr/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ secure_asset('toastr/toastr.min.js') }}"></script>
    <script src="{{ secure_asset('js/main.js') }}"></script>
    

    <x-notifications />
</body>

</html>
