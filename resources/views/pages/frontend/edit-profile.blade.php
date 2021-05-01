@extends('layouts.frontend2')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header text-center">
            Update Profile
        </div>
        <div class="card-body">
            <x-errors />


            <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}


                <div class="form-group">
                    <label for="role">Name</label>

                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        value="{{ $user->name }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="role">Gender</label>
                    <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" required
                        autocomplete="gender" autofocus>
                        <option disabled selected>--Select Gender--</option>
                        <option value="Male" @if ($user->gender == 'Male') selected @endif>Male</option>
                        <option value="Female" @if ($user->role == 'Female') selected @endif>Female</option>
                    </select>

                </div>

                <div class="form-group">
                    <label for="role">Phone</label>
                    <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone"
                        value="{{ $user->phone }}" pattern="^[0-9]*$" id="phone" required autocomplete="phone" autofocus>

                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="role">Email</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ $user->email }}" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="role">Photo</label>
                    <div class="col-3 mr-0">
                        @if ($user->photo != '')
                            <img src="{{ asset($user->photo) }}" class="img-fluid img-thumbnail img-circle" />
                        @endif
                    </div>
                    <div class="col-7 mr-0">
                        <input type="file" class="form-control bottom mt-2" id="photo" name="photo">
                    </div>

                </div>

                <div class="form-group">
                    <button class="btn btn-primary pull-right" type="submit">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
