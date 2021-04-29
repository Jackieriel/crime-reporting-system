@extends('layouts.app')

@section('title')
    Crime Category
@endsection

@section('content')
    <div class="container">
        <a href="{{ route('crime-category.create') }}" class="btn btn-primary">Add Crime Category</a>
        <div class="card">

            <div class="card-header text-center">Crime category</div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <th>name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        @if ($categories->count() > 0)

                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->category_name }}</td>

                                    <td><a href="{{ route('crime-category.edit', $category->id) }}"
                                            class="btn btn-xs btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('crime-category.destroy', $category->id) }}" method="POST">
                                            {{ csrf_field() }}

                                            {{ method_field('DELETE') }}

                                            <button class="btn btn-xs btn-danger"
                                                onclick="return confirm('Do you really want to delete this category?')"
                                                type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        @else
                            <tr>
                                <td colspan="5" class="text-center">No Crime category yet</td>
                            </tr>
                        @endif
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
