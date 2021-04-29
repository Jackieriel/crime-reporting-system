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

            <div class="row">
                <div class="col-md-12">
                    <span class="text-primary">Reported by: </span>{{ $incident->reporter->name }} -
                    {{ $incident->created_at->format('M d,Y \a\t h:i a') }}
                    <hr>
                </div>
                
                <div class="col-md-12">
                    <span class="text-primary">Description: </span><br>
                    {!! Str::substr($incident->description, 0, 250) !!}
                </div>
            </div>
            <hr>

            <form action="{{ route('incident.update', $incident->id) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

                {{-- When using resource method we introduce put --}}
                {{ method_field('PUT') }}

                <div class="form-group">
                    <label for="status"><span class="text-danger">*</span>Crime Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="" selected disabled>Select a category</option>

                        {{-- <option value="{{ $incident->status }}" @if ($incident->status == $incident->status) selected @endif>
                            {{ $incident->status }}
                        </option> --}}

                        <option value="{{ 'pending verification'}}" @if ($incident->status == 'pending verification') selected @endif>
                            {{ 'pending verification' }}
                        </option>

                        <option value="{{ 'verified - investigation openned'}}" @if ($incident->status == 'verified - investigation openned') selected @endif>
                            {{ 'verified - investigation openned' }}
                        </option>

                        <option value="{{ 'verified - investigation closed' }}" @if ($incident->status == 'verified - investigation closed') selected @endif>
                            {{'verified - investigation closed' }}
                        </option>

                    </select>
                </div>

                <div class="form-group">
                    <label for="category"><span class="text-danger">*</span>Crime Category</label>
                    <select name="crime_category_id" id="crime_category" class="form-control">
                        <option value="" selected disabled>Select a category</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if ($incident->crimecategory->id == $category->id) selected @endif>
                                {{ $category->category_name }}</option>
                        @endforeach

                    </select>
                </div>


                <div class="form-group">
                    <button class="btn btn-primary pull-right" type="submit">
                        Update Report
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
