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
                Create Category
            </div>
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" placeholder="Enter Category Name" name="name" class="form-control card-body" />
                <input type="file" class="form-control" name="image">
                <div class="card-body">
                    <div class="form-check form-switch">
                        <label for="status" class="form-check-label">Active or Inactive</label>
                        <input type="checkbox" class="form-check-input" name="status" checked />
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        +Create
                    </button>
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection