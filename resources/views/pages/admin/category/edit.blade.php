@extends('layouts.app')

@section('title')
    Update Crime Category
@endsection

@section('content')
    <div class="card">
        <div class="card-header text-center">
            Update Crime Category
        </div>
        <div class="card-body">
            <x-errors />

            <form action="{{ route('crime-category.update', $category->id) }}" method="POST">
                {{ csrf_field() }}

                {{ method_field('PUT') }}

                <div class="form-group">
                    <label for="name">Category Name</label>
                    <input type="text" name="category_name" id="category_name" class="form-control" required placeholder="category Name"
                        value="{{ $category->category_name }}">
                </div>

                <div class="form-group">
                    <button class="btn btn-primary pull-right" type="submit">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
