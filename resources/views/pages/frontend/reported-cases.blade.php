@extends('layouts.frontend2')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="container">
        <a href="{{ route('dashboard') }}" class="btn btn-primary">Report an incident</a>
        <div class="card">

            <div class="card-header text-center">My Reported Cases</div>
            <div class="card-body">
                <table class="js-table">
                    <thead>
                        <tr>
                            <th scope="col" class="text-left">Category</th>
                            <th scope="col" class="text-left">Status</th>
                            <th scope="col">Reported Date</th>

                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($incidents->count() > 0)

                            @foreach ($incidents as $incident)
                                <tr>
                                    <td class="text-capitalize" scope="row" data-label="Crime Category">
                                        {{ $incident->crimecategory->category_name }}
                                    </td>
                                    <td scope="row" data-label="Reporter" class="text-capitalize">{{ $incident->status }}</td>

                                    {{-- <td>{!! Str::substr($incident->description, 0, 20) !!}</td> --}}
                                    <td scope="row" data-label="Date Reported">
                                        {{ $incident->created_at->format('M d,Y \a\t h:i a') }}</td>
                                    {{-- <td>{{ $incident->created_at->toFormattedDateString() }}</td> --}}

                                    <td class="text-center">
                                        <a href="{{ route('report.show', $incident->id) }}"
                                            class="btn btn-xs btn-primary">View</a>
                                    </td>
                                </tr>
                            @endforeach

                        @else
                            <tr>
                                <td colspan="5" class="text-center">No Reported cases yet</td>
                            </tr>
                        @endif
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
