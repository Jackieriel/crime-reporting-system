@extends('layouts.app')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="container">
        <a href="{{ route('agency.create') }}" class="btn btn-primary">Create Agency Profile</a>
        <div class="card">

            <div class="card-header text-center">Create Agency Profile</div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        @if (Auth::check() && (Auth::user()->is_super_admin() || Auth::user()->is_other_agency()))
                            <th>Agent Name</th>
                            <th>Agency</th>
                            <th>Phone</th>
                            <th>Details</th>
                            <th>Edit</th>
                            <th>Delete</th>

                        @elseif (Auth::check() && Auth::user()->is_security_agency())
                            <th>Agent Name</th>
                            <th>Agency</th>
                            <th>Phone</th>
                            <th>Details</th>
                        @endif
                    </thead>
                    <tbody>
                        @if ($agencies->count() > 0)

                            @foreach ($agencies as $agency)
                                <tr>
                                    <td>
                                        {{ $agency->agent->name }}
                                    </td>
                                    <td class="text-capitalize">{{ $agency->agency_name }}</td>
                                    <td class="text-capitalize">{{ $agency->phone }}</td>


                                    @if (Auth::check() && (Auth::user()->is_super_admin() || Auth::user()->is_other_agency()))
                                        <td><a href="{{ route('agency.show', $agency->id) }}"
                                                class="btn btn-xs btn-primary">View</a>
                                        </td>
                                        <td><a href="{{ route('agency.edit', $agency->id) }}"
                                                class="btn btn-xs btn-primary">Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('agency.destroy', $agency->id) }}" method="POST">
                                                {{ csrf_field() }}

                                                {{ method_field('DELETE') }}

                                                <button class="btn btn-xs btn-danger"
                                                    onclick="return confirm('Do you really want to delete this agency?')"
                                                    type="submit">Delete</button>
                                            </form>
                                        </td>

                                    @elseif(Auth::check() && (Auth::user()->is_security_agency()))
                                        <td><a href="{{ route('agency.show', $agency->id) }}"
                                                class="btn btn-xs btn-primary">View</a>
                                        </td>
                                    @endif

                                </tr>
                            @endforeach

                        @else
                            <tr>
                                <td colspan="5" class="text-center">No Crime agency yet</td>
                            </tr>
                        @endif
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
