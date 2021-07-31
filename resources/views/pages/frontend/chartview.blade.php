@extends('layouts.frontend2')

@section('title')
    {{-- {{ $title }} --}}
@endsection


@section('content')


    <div class="container">
        <div class="card">


            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @if (Auth::check())
                    <div class="card-header text-center text-uppercase">Crime Statistics</div>

                    {{-- Render char --}}
                    <div class="chart">
                        {!! $chart->container() !!}

                        {!! $chart->script() !!}
                    </div>

                @endif


            </div>
        </div>
    </div>

    {{-- @foreach ($incidents as $incident)
        <ul>
            <li>
                {{ $incident->status }}
            </li>
        </ul>

    @endforeach --}}




@endsection
