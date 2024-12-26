@extends('layouts.master')
@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        @if ($errors->any())
        <div class="text-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="card mt-4">
            <div class="card-header">
                Create Article
            </div>
            <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body d-flex flex-column gap-4">
                    <input type="text" placeholder="Enter Article Name" name="name" class="form-control card-body" />
                    <input type="text" placeholder="Enter  Description" name="description" class="form-control card-body" />
                    <input type="file" class="form-control" name="image">
                    <select name="category_id" id="">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">
                            {{$category->name}}
                        </option>
                        @endforeach
                    </select>
                    <div class="card-body">
                        <div class="form-check form-switch">
                            <label for="status" class="form-check-label">Active or Inactive</label>
                            <input type="checkbox" class="form-check-input" name="status" checked />
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        +Create
                    </button>
                    <a href="{{ route('articles.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection