@extends('layouts.app')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header text-center text-uppercase">
           <h4> {{ $agency->agency_name }}</h4>
        </div>

        <div class="card-body">
            <x-errors />



            <div class="row">
                <div class="col-md-12">
                    @if ($agency)
                        Created: {{ $agency->created_at->format('M d,Y \a\t h:i a') }} By
                        {{ $agency->agent->name }}
                        @if ((!Auth::guest() && Auth::user()->is_security_agency()) || Auth::user()->is_super_admin())

                            <button class="btn" style="float: right"><a href="{{ route('agency.edit', $agency->id) }}">
                                    Edit Agency Profile</a>
                            </button>
                        @endif
                    @else
                        Page does not exist
                    @endif
                </div>

                <div class="col-md-12">
                    <ul class="list-group">
                        <li class="list-group-item text-capitalize"><span class="text-primary">Agency Name:
                            </span>{{ $agency->agency_name }}</li>

                        <li class="list-group-item text-capitalize"><span class="text-primary">Phone:
                            </span>{{ $agency->phone }}</li>

                        <li class="list-group-item text-capitalize"><span class="text-primary">Website:
                            </span>{{ $agency->website }}</li>

                        <li class="list-group-item text-capitalize"><span class="text-primary">Email:
                            </span>{{ $agency->email }}</li>
                        <li class="list-group-item text-justify"><span class="text-primary">About:
                            </span><br>
                            {{ $agency->about }}</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>



@endsection
