@extends('layouts.app')

@section('title')
    Create Crime category
@endsection

@section('content')
    <div class="card">
        <div class="card-header text-center">
            Add Crime Category
        </div>
        <div class="card-body">
            <x-errors />

            <form action="{{ route('crime-category.store') }}" method="POST">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="category_name" id="category_name" class="form-control" required placeholder="category Name"
                        value="{{ old('category_name') }}">
                </div>

               
                <div class="form-group">
                    <button class="btn btn-primary pull-right" type="submit">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
