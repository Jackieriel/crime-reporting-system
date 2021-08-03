@extends('layouts.app')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="container">
        <a href="{{ route('report') }}" class="btn btn-primary">Report Crime incident</a>
        <div class="card">

            <div class="card-header text-center">Reported Crime incident</div>
            <div class="card-body">

                {{-- Seach form --}}
                <table class="js-table">
                    <tbody>
                        <tr>
                            <td scope="row" data-label="Search">
                                <form method="GET" action="{{route('incident.search')}}" class="form-inline my-2 my-lg-0">
                                    <input name="search" class="form-control mr-sm-2" type="search" placeholder="Address, LGA"
                                        aria-label="search">
                                    <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>

                </table>
                <br>


                <table class="js-table">
                    <thead>
                        <tr>
                            <th scope="col">Reporter</th>
                            <th scope="col">Category</th>
                            <th scope="col">Reported Date</th>
                            @if (Auth::check() && (Auth::user()->is_security_agency() || Auth::user()->is_super_admin()))
                                <th colspan="2">Action</th>
                                {{-- <th>Edit</th>
                                <th>Delete</th> --}}

                            @elseif(Auth::check() && Auth::user()->is_other_agency())
                                <th scope="col">Details</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @if ($incidents->count() > 0)

                            @foreach ($incidents as $incident)
                                <tr>
                                    <td scope="row" data-label="Reporter">{{ $incident->reporter->name }}</td>
                                    <td class="text-capitalize" scope="row" data-label="Crime Category">
                                        {{ $incident->crimecategory->category_name }}</td>
                                    {{-- <td>{!! Str::substr($incident->description, 0, 20) !!}</td> --}}
                                    <td scope="row" data-label="Date Reported">
                                        {{ $incident->created_at->format('M d,Y \a\t h:i a') }}</td>
                                    {{-- <td>{{ $incident->created_at->toFormattedDateString() }}</td> --}}

                                    @if (Auth::check() && (Auth::user()->is_security_agency() || Auth::user()->is_super_admin()))
                                        <td>
                                            <a href="{{ route('incident.show', $incident->id) }}"
                                                class="btn btn-xs btn-primary">View</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('incident.edit', $incident->id) }}"
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
