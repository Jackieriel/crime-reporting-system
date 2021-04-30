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

            @if (Auth::check())
                <li class="js-nav-item show-menu">
                    <a href="{{ route('home') }}" class="js-nav-link">{{ __('Home') }}</a>
                </li>
            @endif

            @if (Auth::check() && (Auth::user()->is_security_agency() || Auth::user()->is_super_admin()))
                <li class="js-nav-item show-menu">
                    <a href="{{ route('crime-category.index') }}" class="js-nav-link">{{ __('Crime Categories') }}</a>
                </li>

                <li class="js-nav-item show-menu">
                    <a href="{{ route('announcement.index') }}" class="js-nav-link">{{ __('Announcement') }}</a>
                </li>
            @endif


            @if (Auth::check() && (Auth::user()->is_security_agency() || Auth::user()->is_super_admin() || Auth::user()->is_other_agency()))
                <li class="js-nav-item show-menu">
                    <a href="{{ route('incident.index') }}" class="js-nav-link">{{ __('Incidents') }}</a>
                </li>

                <li class="js-nav-item show-menu">
                    <a href="{{ route('agency.index') }}" class="js-nav-link">{{ __('Agency') }}</a>
                </li>
            @endif



        @endguest

    </ul>
    <div class="js-hamburger">
        <span class="js-bar"></span>
        <span class="js-bar"></span>
        <span class="js-bar"></span>
    </div>
</nav>
