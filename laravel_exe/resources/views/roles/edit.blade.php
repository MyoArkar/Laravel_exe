@extends('layouts.master')
@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="card mt-4">
            <div class="card-header">
                Edit Role
            </div>
            <form action="{{ route('roles.update', $role->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body d-flex flex-column gap-4">
                    <input type="text" value="{{ $role->name }}" name="name" class="form-control card-body" />
                </div>
                <div class="card-body d-flex flex-row flex-wrap gap-4">
                    @foreach($permissions as $permission)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="permissions[]" value="{{$permission->name}}" id="flexCheckIndeterminate{{$permission->id}}"
                            @if($role->hasPermissionTo($permission->name)) 
                            checked
                            @endif
                        >
                        <label class="form-check-label" for="flexCheckIndeterminate{{$permission->id}}">
                           {{ $permission->name }}
                        </label>
                    </div>
                    @endforeach
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back</a>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection