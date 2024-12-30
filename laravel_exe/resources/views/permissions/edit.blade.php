@extends('layouts.master')
@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="card mt-4">
            <div class="card-header">
                Edit Permission
            </div>
            <form action="{{ route('permissions.update', $permission->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body d-flex flex-column gap-4">
                    <input type="text" value="{{ $permission->name }}" name="name" class="form-control card-body" />
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Back</a>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection