<nav class="js-navbar">
    <a href="{{ url('/') }}" class="js-nav-logo text-primary">
        {{ config(__('app.name'), 'TessCRSystem ') }}
        {{-- {{ __('TessCRSystem')}} --}}
    </a>
    <ul class="js-nav-menu">
        <li class="js-nav-item">
            
            <a id="google_translate_element" class="js-nav-link"></a>
        </li>
        @guest
        <li class="js-nav-item">
            <a href="{{ route('news') }}" class="js-nav-link">{{ __('News/Info') }}</a>
        </li>

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
                <span class="online"> </span> {{ Auth::user()->name }}
            </li>

            <li class="js-nav-item ">
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

            <li class="js-nav-item show-menu">
                <a href="{{ route('dashboard') }}" class="js-nav-link">Home</a>
            </li>
            <li class="js-nav-item show-menu">
                <a href="{{ route('report') }}" class="js-nav-link">Report Incident</a>
            </li>
            <li class="js-nav-item show-menu">
                <a href="{{ route('report.cases') }}" class="js-nav-link">My Reported Cases</a>
            </li>
            <li class="js-nav-item show-menu">
                <a href="{{ route('user.stat') }}" class="js-nav-link">My Report Statistics</a>
            </li>
            <li class="js-nav-item show-menu">
                <a href="{{ route('user.profile', Auth::user()->id) }}" class="js-nav-link">Manage Profile</a>
            </li>

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
