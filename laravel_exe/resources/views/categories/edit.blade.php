@extends('layouts.master')
@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="card mt-4">
            <div class="card-header">
                Edit Category
            </div>
            <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <input type="text" value="{{ $category->name }}" name="name" class="form-control card-body" />
                    <input type="text" value="{{$category->image}}" name="old_image" class="form-control card-body" hidden />
                    <img src="{{asset('categoryImages/'. $category->image)}}" alt="{{ $category->image}}" style="width:40px;">
                    <input type="file" class="form-control" name="image" />
                    <div class="card-body">
                        <div class="form-check form-switch">
                            <label for="status" class="form-check-label">Active or Inactive</label>
                            <input type="checkbox" class="form-check-input" name="status" {{$category->status == 1 ? "checked" : ""}} />

                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection