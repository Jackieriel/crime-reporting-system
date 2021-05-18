@extends('layouts.app')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header text-center">
            Assign Role
        </div>
        <div class="card-body">
            <x-errors />

            <ul class="list-group">
                <li class="list-group-item text-capitalize"><span class="text-primary">{{ __('Name') }}:
                    </span>{{ $user->name }}</li>

                <li class="list-group-item text-capitalize"><span class="text-primary">{{ __('Current Role') }}:
                    </span>{{ $user->role }}</li>
            </ul>

            <form action="{{ route('role.update', $user->id) }}" method="POST">
                {{ csrf_field() }}

        

                <div class="form-group">
                    <label for="role">Role</label>

                    <select name="role" id="role" class="form-control">
                        <option value="" selected disabled>Select Role</option>
                        <option value="superAdmin" @if ($user->role == 'superAdmin') selected @endif>{{ 'super Admin' }}</option>
                        <option value="securityAgency" @if ($user->role == 'securityAgency') selected @endif>{{ 'Security Agency' }}</option>
                        <option value="otherAgency" @if ($user->role == 'otherAgency') selected @endif>{{ 'Other Agency' }}</option>
                        <option value="reporter" @if ($user->role == 'reporter') selected @endif>{{ 'Reporter' }}</option>
                    </select>
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
