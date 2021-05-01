@extends('layouts.app')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header text-center">
            User Profile
        </div>

        <div class="card-body">
            <x-errors />



            <div class="row">
                <div class="col-md-12">
                    @if ($user)
                        Registered: {{ $user->created_at->format('M d,Y \a\t h:i a') }}
                        
                        @if (!Auth::guest() && Auth::user()->is_super_admin())

                            <button class="btn" style="float: right"><a href="{{ route('role.edit' , $user->id) }}">
                                    Edit user</a>
                            </button>
                        @endif
                    @else
                        Page does not exist
                    @endif
                </div>

                <div class="col-md-12">
                    <ul class="list-group">
                        <li class="list-group-item text-capitalize"><span class="text-primary">{{ __('Name') }}:
                            </span>{{ $user->name }}</li>

                        <li class="list-group-item text-capitalize"><span class="text-primary">{{ __('Email') }}:
                            </span>{{ $user->email }}</li>

                        <li class="list-group-item text-capitalize"><span class="text-primary">{{ __('Gender') }}:
                            </span>{{ $user->gender }}</li>

                        <li class="list-group-item text-capitalize"><span class="text-primary">{{ __('Phone') }}:
                            </span>{{ $user->phone }}</li>
                        <li class="list-group-item text-justify"><span class="text-primary">{{ __('Status') }}:
                            </span>
                            {{ $user->status }}</li>
                            <li class="list-group-item text-justify"><span class="text-primary">{{ __('Role') }}:
                            </span><br>
                            {{ $user->role }}</li>

                        <li class="list-group-item text-capitalize"><span class="text-primary">{{ __('Photo') }}:
                            </span><br>
                            {{-- {{ $user->photo }} --}}
                            @if (empty($user->photo))
                                No photo 
                            @else
                                <figure>
                                    <img src="{{ asset($user->photo) }}" class="img-fluid" alt="">
                                </figure>
                            @endif

                        </li>

                    
                    </ul>

                </div>
            
            </div>

        </div>
    </div>



@endsection
