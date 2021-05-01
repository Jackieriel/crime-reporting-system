@extends('layouts.app')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="container">
       
        <div class="card">

            <div class="card-header text-center">Users</div>
            <div class="card-body">
                <table class="js-table">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>                           
                            <th scope="col">Registered On</th>
                            @if (Auth::check() &&  Auth::user()->is_super_admin())
                                <th colspan="2">Action</th>

                            @elseif(Auth::check() && Auth::user()->is_security_agency())
                                <th scope="col">Details</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @if ($users->count() > 0)

                            @foreach ($users as $user)
                                <tr>
                                    <td scope="row" data-label="Name">{{ $user->name }}</td>                                    
                                    <td scope="row" data-label="Registered On">{{ $user->created_at->format('M d,Y \a\t h:i a') }}</td>
                                    {{-- <td>{{ $user->created_at->toFormattedDateString() }}</td> --}}

                                    @if (Auth::check() &&  Auth::user()->is_super_admin())
                                        <td>
                                            <a href="{{ route('user.show', $user->id) }}"
                                                class="btn btn-xs btn-primary">View</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('role.edit', $user->id) }}"
                                                class="btn btn-xs btn-primary">Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                                {{ csrf_field() }}

                                                {{ method_field('DELETE') }}

                                                <button class="btn btn-xs btn-danger"
                                                    onclick="return confirm('Do you really want to delete this user?')"
                                                    type="submit">Delete</button>
                                            </form>
                                        </td>

                                    @elseif(Auth::check() && Auth::user()->is_security_agency())
                                        <td><a href="{{ route('user.show', $user->id) }}"
                                                class="btn btn-xs btn-primary">View</a>
                                        </td>
                                    @endif

                                </tr>
                            @endforeach

                        @else
                            <tr>
                                <td colspan="5" class="text-center">No user yet</td>
                            </tr>
                        @endif
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
