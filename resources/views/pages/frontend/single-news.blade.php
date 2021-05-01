@extends('layouts.frontend2')

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
                    @else
                        Page does not exist
                    @endif
                </div>

                <div class="col-md-12">
                    <ul class="list-group">
                        <li class="list-group-item text-capitalize"><span class="text-primary">Heading:
                            </span><br>{{ $announcement->title }}</li>

                        <li class="list-group-item text-capitalize text-justify"><span class="text-primary">News/Announcement:
                                <br>
                            </span>{{ $announcement->description }}</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>



@endsection
