@extends('layouts.app')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="container">
        <div class="card">

            <div class="card-header text-center">News/Announcement</div>
            <div class="card-body">
                <table class="js-table">
                    <thead>
                        <th scope="col" class="text-left">Heading</th>
                        <th scope="col" class="text-left">Updated</th>
                        <th scope="col" class="text-center">Action</th>
                    </thead>
                    <tbody>
                        @if ($announcements->count() > 0)

                            @foreach ($announcements as $announcement)
                                <tr>
                                    <td class="text-capitalize" data-label="Title">
                                        <a href="{{route('news.show', $announcement->id)}}">{!! Str::substr($announcement->title, 0, 30) !!}</a>
                                      
                                    </td>
                                    <td class="text-capitalize" data-label="Posted">
                                        {{ $announcement->created_at->format('M d,Y \a\t h:i a') }}
                                    </td>
                                    <td class="text-capitalize text-center">
                                        <a href="{{route('news.show', $announcement->id)}}" class="btn btn-success btn-sm text-white">Read </a>
                                    </td>
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
