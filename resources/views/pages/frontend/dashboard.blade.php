@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Dashboard</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                You are logged in!
                <h1>This is user dashboard</h1>
            </div>
        </div>
    </div>

@endsection
