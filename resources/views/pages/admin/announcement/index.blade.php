@extends('layouts.app')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="container">
        <a href="{{ route('announcement.create') }}" class="btn btn-primary">Post Announcement</a>
        <div class="card">

            <div class="card-header text-center">Post announcement</div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        @if (Auth::check() && (Auth::user()->is_super_admin() || Auth::user()->is_security_agency()))
                            <th>Title</th>
                            <th>Updated</th>
                            <th>Details</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        @endif
                    </thead>
                    <tbody>
                        @if ($announcements->count() > 0)

                            @foreach ($announcements as $announcement)
                                <tr>
                                    <td class="text-capitalize">{!! Str::substr($announcement->title, 0, 30) !!}</td>
                                    <td class="text-capitalize">{{ $announcement->created_at->format('M d,Y') }}</td>


                                    @if (Auth::check() && (Auth::user()->is_super_admin() || Auth::user()->is_security_agency()))
                                        <td><a href="{{ route('announcement.show', $announcement->id) }}"
                                                class="btn btn-xs btn-primary">View</a>
                                        </td>
                                        <td><a href="{{ route('announcement.edit', $announcement->id) }}"
                                                class="btn btn-xs btn-primary">Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('announcement.destroy', $announcement->id) }}"
                                                method="POST">
                                                {{ csrf_field() }}

                                                {{ method_field('DELETE') }}

                                                <button class="btn btn-xs btn-danger"
                                                    onclick="return confirm('Do you really want to delete this announcement?')"
                                                    type="submit">Delete</button>
                                            </form>
                                        </td>
                                    @endif

                                </tr>
                            @endforeach

                        @else
                            <tr>
                                <td colspan="5" class="text-center">No Announcement yet</td>
                            </tr>
                        @endif
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
