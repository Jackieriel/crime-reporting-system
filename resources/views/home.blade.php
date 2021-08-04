@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">{{ __('Dashboard') }}</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                {{ __('Welcome ') }} <span class="text-primary">{{ Auth::user()->name }}</span>
            </div>
        </div>


        @if (Auth::check())
            <div class="card">
                <div class="row m-0">
                    <div class="col-md-3 card card-header  text-center">
                        <div class="card card-heading bg-primary text-white text-uppercase">
                            TOTAL CRIME CATEGORIES
                        </div>
                        {{-- <a href="{{ route('category.index') }}"> --}}
                        <div class="card card-body">
                            <h1>{{ $category_count }}</h1>
                        </div>
                        {{-- </a> --}}
                    </div>

                    <div class="col-md-3 card card-header  text-center">
                        <div class="card card-heading bg-primary text-white text-uppercase">
                            Total Crimes Reported
                        </div>
                        {{-- <a href="{{ route('product.index') }}"> --}}
                        <div class="card card-body">
                            <h1>{{ $total_reported_case }}</h1>
                        </div>
                        {{-- </a> --}}
                    </div>



                    <div class="col-md-3 card card-header  text-center">
                        <div class="card card-heading bg-primary text-white text-uppercase">
                            Total Open Invistigation
                        </div>
                        {{-- <a href="{{ route('staff.index') }}"> --}}
                        <div class="card card-body">
                            <h1>{{ $total_case_open }}</h1>
                        </div>
                        {{-- </a> --}}
                    </div>

                    <div class="col-md-3 card card-header  text-center">
                        <div class="card card-heading bg-primary text-white text-uppercase">
                            Total Closed Invistigation
                        </div>
                        {{-- <a href="{{ route('staff.index') }}"> --}}
                        <div class="card card-body">
                            <h1>{{ $total_case_close }}</h1>
                        </div>
                        {{-- </a> --}}
                    </div>
                </div>
            </div>
        @endif
        <p></p>

        {{-- Recent reported case --}}

        <div class="card">
            <div class="row m-0">
                <div class="col-md-12">
                    <h4 class="text-center p-2">Recent Reported Cases Pending verification</h4>


                    <table class="js-table">
                        <thead>
                            <tr>
                                <th scope="col">Reporter</th>
                                <th scope="col">Category</th>
                                <th scope="col">Reported Date</th>
                                @if (Auth::check() && (Auth::user()->is_security_agency() || Auth::user()->is_super_admin()))
                                    <th>Action</th>

                                @elseif(Auth::check() && Auth::user()->is_other_agency())
                                    <th scope="col">Details</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @if ($incidents->count() > 0)

                                @foreach ($incidents as $incident)
                                    <tr>
                                        <td scope="row" data-label="Reporter">{{ $incident->reporter->name }}</td>
                                        <td class="text-capitalize text-center" scope="row" data-label="Crime Category">
                                            {{ $incident->crimecategory->category_name }}</td>
                                        {{-- <td>{!! Str::substr($incident->description, 0, 20) !!}</td> --}}
                                        <td scope="row" data-label="Date Reported">
                                            {{ $incident->created_at->format('M d,Y \a\t h:i a') }}</td>
                                        {{-- <td>{{ $incident->created_at->toFormattedDateString() }}</td> --}}

                                        @if (Auth::check() && (Auth::user()->is_security_agency() || Auth::user()->is_super_admin()))
                                            <td class="text-center">
                                                <a href="{{ route('incident.show', $incident->id) }}"
                                                    class="btn btn-xs btn-primary">View</a>
                                            </td>                                            

                                        @elseif(Auth::check() && Auth::user()->is_other_agency())
                                            <td><a href="{{ route('incident.show', $incident->id) }}"
                                                    class="btn btn-xs btn-primary">View</a>
                                            </td>
                                        @endif

                                    </tr>
                                @endforeach

                            @else
                                <tr>
                                    <td colspan="5" class="text-center">No Crime incident yet</td>
                                </tr>
                            @endif
                        </tbody>

                    </table>
                </div>





            </div>
        </div>







    </div>






@endsection
