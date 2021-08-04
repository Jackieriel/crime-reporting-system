@extends('layouts.frontend2')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-header">
                <h4 class="text-center text-primary text-uppercase">{{ __('TessCRSystem  Dashboard') }}</h4>
            </div>


            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                {{ __('Sign-in as') }}
                <span class="text-primary">

                    <a href="{{ route('user.profile', Auth::user()->id) }}">{{ Auth::user()->name }}</a>
                </span>
                <a href="{{ route('report') }}" class="btn btn-sm btn-success float-right">Report Incident</a>
            </div>

        </div>


        @if (Auth::check())
            <div class="card">
                <div class="row m-0">
                    <div class="col-md-3 card card-header  text-center">
                        <div class="card card-heading bg-primary text-white text-uppercase">
                            Total Crimes Reported
                        </div>

                        <div class="card card-body">
                            <h1>{{ $total_reported_case }}</h1>
                        </div>

                    </div>

                    <div class="col-md-3 card card-header  text-center">
                        <div class="card card-heading bg-primary text-white text-uppercase">
                            Total Pending Verification
                        </div>

                        <div class="card card-body">
                            <h1>{{ $total_case_pending }}</h1>
                        </div>

                    </div>



                    <div class="col-md-3 card card-header  text-center">
                        <div class="card card-heading bg-primary text-white text-uppercase">
                            Total Open Invistigation
                        </div>

                        <div class="card card-body">
                            <h1>{{ $total_case_open }}</h1>
                        </div>

                    </div>

                    <div class="col-md-3 card card-header  text-center">
                        <div class="card card-heading bg-primary text-white text-uppercase">
                            Total Closed Invistigation
                        </div>

                        <div class="card card-body">
                            <h1>{{ $total_case_close }}</h1>
                        </div>

                    </div>
                </div>
            </div>
        @endif


        {{-- User Recent reported case --}}
        <p></p>
        <div class="card-body">
            <div class="card-header text-center">
                <h4>My Recent Reported Cases Pending verification</h4>
            </div>
            <table class="js-table">
                <thead>
                    <tr>
                        <th scope="col" class="text-left">Category</th>
                        <th scope="col" class="text-left">Status</th>
                        <th scope="col">Reported Date</th>

                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($incidents->count() > 0)

                        @foreach ($incidents as $incident)
                            <tr>
                                <td class="text-capitalize" scope="row" data-label="Crime Category">
                                    {{ $incident->crimecategory->category_name }}
                                </td>
                                <td scope="row" data-label="Reporter" class="text-capitalize">{{ $incident->status }}
                                </td>

                                {{-- <td>{!! Str::substr($incident->description, 0, 20) !!}</td> --}}
                                <td scope="row" data-label="Date Reported">
                                    {{ $incident->created_at->format('M d,Y \a\t h:i a') }}</td>
                                {{-- <td>{{ $incident->created_at->toFormattedDateString() }}</td> --}}

                                <td class="text-center">
                                    <a href="{{ route('report.show', $incident->id) }}"
                                        class="btn btn-xs btn-primary">View</a>
                                </td>
                            </tr>


                        @endforeach




                    @else
                        <tr>
                            <td colspan="5" class="text-center">No Reported cases yet</td>
                        </tr>
                    @endif
                </tbody>

            </table>
            <div class="text-center">
                <a href="{{ route('report.cases') }}" class="btn btn-primary btn-block"><span
                        class="fa fa-arrow-right"></span> All Reported Cases</a>

            </div>
        </div>


    </div>


@endsection
