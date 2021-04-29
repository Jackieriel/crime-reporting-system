@extends('layouts.app')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header text-center">
            {{ $title }}
        </div>

        <div class="card-body">
            <x-errors />

            <form action="{{ route('announcement.update', $announcement->id) }}" method="POST">
                {{ csrf_field() }}

                {{-- When using resource method we introduce put --}}
                {{ method_field('PUT') }}

                <div class="form-group">
                    <label for="title"><span class="text-danger">*</span>Title</label>
                    <input type="text" name="title" id="title" class="form-control" required placeholder="Title"
                        value="{{ $announcement->title }}">
                </div>

                <div class="form-group">
                    <label for="about"><span class="text-danger">*</span>Announcment</label>

                    <textarea name="description" id="description" cols="30" rows="10"
                        class="form-control">{{ $announcement->title  }}</textarea>
                </div>

                <div class="form-group">
                    <label for="status"><span class="text-danger">*</span>Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="" selected disabled>Select Status</option>
                        <option value="published" @if ($announcement->status == 'published') selected @endif>{{'Publish'}}</option>
                        <option value="unpublished" @if ($announcement->status == 'unpublished') selected @endif>{{'Draft'}}</option>
                    </select>
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
