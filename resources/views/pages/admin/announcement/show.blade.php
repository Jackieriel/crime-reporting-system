@extends('layouts.app')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header text-center text-uppercase">
           <h4> {{ $announcement->title }}</h4>
        </div>

        <div class="card-body">
            <x-errors />



            <div class="row">
                <div class="col-md-12">
                    @if ($announcement)
                        Posted: {{ $announcement->created_at->format('M d,Y \a\t h:i a') }}

                        @if ((!Auth::guest() && Auth::user()->is_security_agency()) || Auth::user()->is_super_admin())

                            <button class="btn" style="float: right"><a href="{{ route('announcement.edit', $announcement->id) }}">
                                    Edit Announcement</a>
                            </button>
                        @endif
                    @else
                        Page does not exist
                    @endif
                </div>

                <div class="col-md-12">
                    <ul class="list-group">
                        <li class="list-group-item text-capitalize"><span class="text-primary">Title:
                            </span>{{ $announcement->title }}</li>

                        <li class="list-group-item text-capitalize text-justify"><span class="text-primary">Announcement: <br>
                            </span>{{ $announcement->description }}</li>

                        <li class="list-group-item text-capitalize"><span class="text-primary">Status:
                            </span>{{ $announcement->status }}</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>



@endsection
