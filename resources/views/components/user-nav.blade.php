<nav class="js-navbar">
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
                <a href="{{ route('incident.index') }}" class="js-nav-link">Incidents</a>
            </li>

        @endguest

    </ul>
    <div class="js-hamburger">
        <span class="js-bar"></span>
        <span class="js-bar"></span>
        <span class="js-bar"></span>
    </div>
</nav>
