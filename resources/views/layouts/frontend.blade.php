<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TessCrimeRS') }}</title>

    <!-- Scripts -->
    <script src="{{ secure_asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/db163c922e.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('css/custom.css') }}" rel="stylesheet">

    <link href="{{ secure_asset('toastr/toastr.min.css') }}" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
</head>
<body class="front-bg">

    {{-- <div id="google_translate_element" style="display: none;"></div> --}}
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                includedLanguages: 'en,ha,ig,fr',
                // layout: google.translate.TranslateElement.InlineLayout.SIMPLE
            }, 'google_translate_element');

            // jQuery('.goog-logo-link').css('display', 'none');
            // jQuery('.goog-te-gadget').css('font-size', '0');
        }

    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>


    <div id="app">
       <x-user-nav />
        {{-- <div class="languages">
            @foreach(config()->get('app.locales') as $code => $lang)
                <a href="http://{{$code}}.laravel.test">{{ $lang }}</a>
            @endforeach
        </div> --}}
        
        <main class="py-4">
            @yield('content')
        </main>
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
