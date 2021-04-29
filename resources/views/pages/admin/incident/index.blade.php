@extends('layouts.app')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="container">
        <a href="{{ route('incident.create') }}" class="btn btn-primary">Report Crime incident</a>
        <div class="card">

            <div class="card-header text-center">Reported Crime incident</div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <th>Reporter</th>
                        <th>Category</th>
                        <th>Reported Date</th>
                        @if (Auth::check() && (Auth::user()->is_security_agency() || Auth::user()->is_super_admin()))
                            <th>Details</th>
                            <th>Edit</th>
                            <th>Delete</th>

                        @elseif(Auth::check() && Auth::user()->is_other_agency())
                            <th>Details</th>
                        @endif
                    </thead>
                    <tbody>
                        @if ($incidents->count() > 0)

                            @foreach ($incidents as $incident)
                                <tr>
                                    <td>{{ $incident->reporter->name }}</td>
                                    <td class="text-capitalize">{{ $incident->crimecategory->category_name }}</td>
                                    {{-- <td>{!! Str::substr($incident->description, 0, 20) !!}</td> --}}
                                    <td>{{ $incident->created_at->format('M d,Y \a\t h:i a') }}</td>
                                    {{-- <td>{{ $incident->created_at->toFormattedDateString() }}</td> --}}

                                    @if (Auth::check() && (Auth::user()->is_security_agency() || Auth::user()->is_super_admin()))
                                        <td><a href="{{ route('incident.show', $incident->id) }}"
                                                class="btn btn-xs btn-primary">View</a>
                                        </td>
                                        <td><a href="{{ route('incident.edit', $incident->id) }}"
                                                class="btn btn-xs btn-primary">Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('incident.destroy', $incident->id) }}" method="POST">
                                                {{ csrf_field() }}

                                                {{ method_field('DELETE') }}

                                                <button class="btn btn-xs btn-danger"
                                                    onclick="return confirm('Do you really want to delete this incident?')"
                                                    type="submit">Delete</button>
                                            </form>
                                        </td>

                                    @elseif(Auth::check() && Auth::user()->is_other_agency())
                                        <td><a href="{{ route('incident.show', $incident->id) }}"
                                                class="btn btn-xs btn-primary">View</a>
                                        </td>
                                    @endif

                                </tr>
                            @endforeach

                        @else
                            <tr>
                                <td colspan="5" class="text-center">No Crime incident yet</td>
                            </tr>
                        @endif
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
