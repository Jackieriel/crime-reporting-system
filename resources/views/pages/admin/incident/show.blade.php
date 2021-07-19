@extends('layouts.app')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header text-center">
            Reported Incident Full Details
        </div>

        <div class="card-body">
            <x-errors />



            <div class="row">
                <div class="col-md-12">
                    @if ($incident)
                        Reported: {{ $incident->created_at->format('M d,Y \a\t h:i a') }} By
                        {{ $incident->reporter->name }}
                        @if ((!Auth::guest() && Auth::user()->is_security_agency()) || Auth::user()->is_super_admin())

                            <button class="btn" style="float: right"><a href="{{ route('incident.edit' , $incident->id) }}">
                                    Edit Incident</a>
                            </button>
                        @endif
                    @else
                        Page does not exist
                    @endif
                </div>

                <div class="col-md-12">
                    <ul class="list-group">
                        <li class="list-group-item text-justify"><span class="text-primary">Reporter Phone:
                        </span><br>
                        {{ $incident->reporter->phone }}</li>

                        <li class="list-group-item text-capitalize"><span class="text-primary">Crime Category:
                            </span>{{ $incident->crimecategory->category_name }}</li>

                        <li class="list-group-item text-capitalize"><span class="text-primary">Status:
                            </span>{{ $incident->status }}</li>

                        <li class="list-group-item text-capitalize"><span class="text-primary">LGA of Incident:
                            </span>{{ $incident->lga }}</li>

                        <li class="list-group-item text-capitalize"><span class="text-primary">Address of Incident:
                            </span>{{ $incident->address }}</li>
                        <li class="list-group-item text-justify"><span class="text-primary">Description/Statement:
                            </span><br>
                            {{ $incident->description }}</li>

                        <li class="list-group-item text-capitalize"><span class="text-primary">Photo Evidence:
                            </span><br>
                            {{-- {{ $incident->photo }} --}}
                            @if (empty($incident->photo))
                                No photo evidence
                            @else
                                <figure>
                                    <img src="{{ asset($incident->photo) }}" class="img-fluid" alt="">
                                </figure>
                            @endif

                        </li>

                        <li class="list-group-item text-capitalize"><span class="text-primary">Video Evidence:
                            </span><br>

                            @if (empty($incident->video))
                                {{ 'No video evidence' }}
                            @else
                                <div class="embed-responsive embed-responsive-16by9">
                                    <video class="embed-responsive-item" controls>
                                        <source src="{{ URL::asset($incident->video) }}" type="video/mp4">
                                        Your browser does not support the video.
                                    </video>

                                </div>
                            @endif

                        </li>

                    
                    </ul>

                </div>

                <div class="col-md-12">
                    

                    @if ((!Auth::guest() && Auth::user()->is_security_agency()) || Auth::user()->is_super_admin())

                    <h5 class="pt-4">Feedback/Progress Remark</h5>
                        <div class="panel-body">
                            <form method="post" action="{{ route('feedback.store') }}">
                                {{ csrf_field() }}

                                <input type="hidden" name="on_incident" value="{{ $incident->id }}">
                                <input type="hidden" name="name" value="{{ $incident->reporter->name }}">
                                <input type="hidden" name="email" value="{{ $incident->reporter->email }}">

                                <div class="form-group">
                                    <textarea required="required" placeholder="Enter remark here" name="body"
                                        class="form-control"></textarea>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Remark" />
                            </form>
                        </div>

                    {{-- @else
                        <p>Login to Remark</p> --}}
                    @endif



                    @if ($feedbacks)
                        <div class="col-md-12 pt-3">
                            <h3 class="text-center text-uppercase">Feedback/Progress</h3>
                            <ul style="list-style: none; padding: 0">
                                @foreach ($feedbacks as $feedback)
                                    <li class="panel-body">
                                        <div class="list-group">
                                            <div class="card-header">
                                                {{ $feedback->reporter->name }}
                                                {{ $feedback->created_at->format('M d,Y \a\t h:i a') }}

                                            </div>
                                            <div class="list-group-item">
                                                {{ $feedback->body }}
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                {{-- @else
                404 error
                @endif --}}

            </div>

        </div>
    </div>



@endsection
