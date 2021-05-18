    <div class="card card-body">
        <ul class="list-group">
            @if (Auth::check())
                <li class="list-group-item">
                    <a href="{{ route('home') }}">Home</a>
                </li>

            @endif

            {{-- Reporter Links --}}
            @if (Auth::check() && Auth::user()->is_reporter())
                <li class="list-group-item">
                    <a href="{{ route('report') }}">Report Incident</a>
                </li>

                <li class="list-group-item">
                    <a href="{{ route('report.cases') }}">My Reported Cases</a>
                </li>

                <li class="list-group-item">
                    <a href="{{ route('user.stat') }}">Report Statistics</a>
                </li>

                <li class="list-group-item">
                    <a href="{{ route('user.profile', Auth::user()->id) }}">Manage Profile</a>
                </li>

            @endif
            
            <li class="list-group-item">
                <a href="{{ route('news') }}">News/Info</a>
            </li>

             {{-- End reporter link --}}

            @if (Auth::check() && (Auth::user()->is_security_agency() || Auth::user()->is_super_admin()))
                <li class="list-group-item">
                    <a href="{{ route('crime-category.index') }}">Crime Categories</a>
                </li>

                <li class="list-group-item">
                    <a href="{{ route('announcement.index') }}">Announcement</a>
                </li>
            @endif


            @if (Auth::check() && (Auth::user()->is_security_agency() || Auth::user()->is_super_admin() || Auth::user()->is_other_agency()))
                <li class="list-group-item">
                    <a href="{{ route('incident.index') }}">Incidents</a>
                </li>

                <li class="list-group-item">
                    <a href="{{ route('crime.stats') }}">Crime Statistics</a>
                </li>

                <li class="list-group-item">
                    <a href="{{ route('agency.index') }}">Agency</a>
                </li>
            @endif

            @if (Auth::check() &&  Auth::user()->is_super_admin())
                <li class="list-group-item">
                    <a href="{{ route('users') }}">Manage Users</a>
                </li>
            @endif

        </ul>

    </div>
