@extends('layouts.app')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header text-center">
            Create Agency Profile
        </div>
        <i class="pl-3">Fields with * are compulsory</i>
        <div class="card-body">
            <x-errors />

            <form action="{{ route('agency.store') }}" method="POST">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="agent_id"><span class="text-danger">*</span>Agent Name</label>
                    <select name="agent_id" id="agent_id" class="form-control">
                        <option value="" selected disabled>Select an Agent</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="agency_name"><span class="text-danger">*</span>Agency Name</label>
                    <input type="text" name="agency_name" id="agency_name" class="form-control" required
                        placeholder="Agency Name" value="{{ old('agency_name') }}">
                </div>

                <div class="form-group">
                    <label for="phone"><span class="text-danger">*</span>Phone</label>
                    <input type="text" name="phone" pattern="^[0-9]*$" id="phone" class="form-control" required placeholder="Contact Phone"
                        value="{{ old('phone') }}">
                </div>

                <div class="form-group">
                    <label for="website"><span class="text-danger"></span>Website</label>
                    <input type="url" name="website" id="website" class="form-control" required
                        placeholder="Website (https://www..)" value="{{ old('website') }}">
                </div>

                <div class="form-group">
                    <label for="email"><span class="text-danger"></span>Email</label>
                    <input type="email" name="email" id="email" class="form-control" required
                        placeholder="Email" value="{{ old('email') }}">
                </div>


                <div class="form-group">
                    <label for="about"><span class="text-danger">*</span>About</label>

                    <textarea name="about" id="about" cols="30" rows="10"
                        class="form-control">{{ old('about') }}</textarea>
                </div>

                
                <div class="form-group">
                    <button class="btn btn-primary pull-right" type="submit">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
