@extends('layouts.app')

@section('title')
    Crime Category
@endsection

@section('content')
    <div class="container">
        {{-- <a href="{{ route('crime-category.create') }}" class="btn btn-primary">Add Crime Category</a> --}}
        <div class="card">

            <div class="card-header text-center">Crime category</div>
            <div class="card-body">
                <table class="js-table">
                    <thead>
                        <th scope="col">Crime Category</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </thead>
                    <tbody>
                        @if ($categories->count() > 0)

                            @foreach ($categories as $category)
                                <tr>
                                    <td scope="row" data-label="Category">{{ $category->category_name }}</td>

                                    <td class="text-center"><a href="{{ route('crime-category.edit', $category->id) }}"
                                            class="btn btn-xs btn-primary">Edit</a>
                                    </td>
                                    <td class="text-center">
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
