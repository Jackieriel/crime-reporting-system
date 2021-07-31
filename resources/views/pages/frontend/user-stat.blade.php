@extends('layouts.frontend2')

@section('title')
    {{ $title }}
@endsection


@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header text-center text-uppercase">Statistics</div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

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
            </div>
        </div>
    </div>


@endsection
