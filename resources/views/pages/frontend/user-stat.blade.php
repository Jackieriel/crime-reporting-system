@extends('layouts.frontend2')

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
                            TOTAL CRIME CATEGORIES
                        </div>
                        {{-- <a href="{{ route('category.index') }}"> --}}
                        <div class="card card-body">
                            {{-- <h1>{{ $category_count }}</h1> --}}
                        </div>
                        {{-- </a> --}}
                    </div>

                    <div class="col-md-3 card card-header  text-center">
                        <div class="card card-heading bg-primary text-white text-uppercase">
                            Total Crimes Reported
                        </div>
                        {{-- <a href="{{ route('product.index') }}"> --}}
                        <div class="card card-body">
                            {{-- <h1>{{ $total_reported_case }}</h1> --}}
                        </div>
                        {{-- </a> --}}
                    </div>



                    <div class="col-md-3 card card-header  text-center">
                        <div class="card card-heading bg-primary text-white text-uppercase">
                            Total Open Invistigation
                        </div>
                        {{-- <a href="{{ route('staff.index') }}"> --}}
                        <div class="card card-body">
                            {{-- <h1>{{ $total_case_open }}</h1> --}}
                        </div>
                        {{-- </a> --}}
                    </div>

                    <div class="col-md-3 card card-header  text-center">
                        <div class="card card-heading bg-primary text-white text-uppercase">
                            Total Closed Invistigation
                        </div>
                        {{-- <a href="{{ route('staff.index') }}"> --}}
                        <div class="card card-body">
                            {{-- <h1>{{ $total_case_close }}</h1> --}}
                        </div>
                        {{-- </a> --}}
                    </div>
                </div>
            </div>
        @endif
            </div>
        </div>
    </div>

@endsection
