@extends('layouts.frontend2')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header text-center">
            Profile
        </div>

        <div class="card-body">
            <x-errors />



            <div class="row">

                <div class="col-md-12">
                    <div class="wrapper row">
                        <div class="preview col-md-4 pt-5">
                            <div class="preview-pic tab-content">
                                <div class="tab-pane active" id="pic-1"><img src="{{ asset($user->photo) }}"
                                        class="img-fluid img-thumbnail" alt="{{ $user->name }}" srcset=""></div>
                            </div>
                        </div>
                        <div class="details col-md-8">

                            <h3 class="profile-title text-primary">{{ $user->name }}

                                @if ($user)

                                    @if (!Auth::guest() && Auth::user()->is_reporter())

                                        <button class="btn btn-xs btn-light" style="float: right"><a
                                                href="{{ route('profile.edit', $user->id) }}">
                                                Edit Profile</a>
                                        </button>
                                    @endif
                                @else
                                    Page does not exist
                                @endif

                            </h3>

                            <p class="profile-description"><b>Gender: </b> {{ $user->gender }}</p>
                            <p class="profile-description"><b>Phone: </b> {{ $user->phone }}</p>
                            <p class="profile-description"><b>Email: </b> {{ $user->email }}</p>
                            <p class="profile-description text-capitalize"><b>Status: </b> {{ $user->status }}</p>
                            <p class="profile-description text-capitalize text-muted"><b>Role: </b> {{ $user->role }}</p>
                            <p class="profile-description text-capitalize"><b>Registered: </b>
                                {{ $user->created_at->format('M d,Y \a\t h:i a') }}</p>

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>



@endsection
