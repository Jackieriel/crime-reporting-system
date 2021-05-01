@extends('layouts.frontend2')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header text-center">
            Report an Incident
        </div>
        <i class="pl-3">Fields with * are compulsory</i>
        <div class="card-body">
            <x-errors />

            <form action="{{ route('report.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="name"><span class="text-danger">*</span>Phone</label>
                    <input type="text" name="phone" pattern="^[0-9]*$" id="phone" class="form-control" required placeholder="Contact Phone"
                        value="{{ old('phone') }}">
                </div>

                <div class="form-group">
                    <label for="lga"><span class="text-danger">*</span>Incident Location (LGA)</label>
                    <input type="text" name="lga" id="lga" class="form-control" required
                        placeholder="Incident Location (LGA)" value="{{ old('lga') }}">
                </div>

                <div class="form-group">
                    <label for="name"><span class="text-danger">*</span>Incident Location (Address)</label>
                    <input type="text" name="address" id="address" class="form-control" required
                        placeholder="Incident Location (Address)" value="{{ old('address') }}">
                </div>

                <div class="form-group">
                    <label for="category"><span class="text-danger">*</span>Crime Category</label>
                    <select name="crime_category_id" id="crime_category" class="form-control">
                        <option value="" selected disabled>Select a category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="description"><span class="text-danger">*</span>Description/Statement</label>

                    <textarea name="description" id="description" cols="30" rows="10" 
                    class="form-control">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="photo">Photo Edvince (If available)</label>
                    <input type="file" name="photo" id="photo" class="form-control" value="{{ old('photo') }}">
                </div>

                <div class="form-group">
                    <label for="name">Video Edvince (If available)</label>
                    <input type="file" name="video" id="video" class="form-control" value="{{ old('video') }}">
                </div>


                <div class="form-group">
                    <button class="btn btn-primary pull-right" type="submit">
                        Report
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
