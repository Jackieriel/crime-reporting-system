@extends('layouts.app')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header text-center">
            {{ $title }}
        </div>

        <div class="card-body">
            <x-errors />

            <form action="{{ route('agency.update', $agency->id) }}" method="POST">
                {{ csrf_field() }}

                {{-- When using resource method we introduce put --}}
                {{ method_field('PUT') }}

                <div class="form-group">
                    <label for="agency_name"><span class="text-danger">*</span>Agency Name</label>
                    <input type="text" name="agency_name" id="agency_name" class="form-control" required
                        placeholder="Agency Name" value="{{$agency->agency_name }}">
                </div>

                <div class="form-group">
                    <label for="phone"><span class="text-danger">*</span>Phone</label>
                    <input type="text" name="phone" pattern="^[0-9]*$" id="phone" class="form-control" required
                        placeholder="Contact Phone" value="{{$agency->phone }}">
                </div>

                <div class="form-group">
                    <label for="website"><span class="text-danger"></span>Website</label>
                    <input type="url" name="website" id="website" class="form-control" required
                        placeholder="Website (https://www..)" value="{{$agency->website }}">
                </div>

                <div class="form-group">
                    <label for="email"><span class="text-danger"></span>Email</label>
                    <input type="email" name="email" id="email" class="form-control" required placeholder="Email"
                        value="{{$agency->email }}">
                </div>


                <div class="form-group">
                    <label for="about"><span class="text-danger">*</span>About</label>

                    <textarea name="about" id="about" cols="30" rows="10"
                        class="form-control">{{$agency->about }}</textarea>
                </div>


                <div class="form-group">
                    <button class="btn btn-primary pull-right" type="submit">
                        Update Profile
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
