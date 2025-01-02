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
                Edit User
            </div>
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body d-flex flex-column gap-4">
                    <input type="text" placeholder="Enter User Name" name="name" class="form-control card-body" value="{{$user->name}}" />
                    <input type="text" placeholder="Enter  Email" name="email" class="form-control card-body" value="{{$user->email}}" />
                    <img src="{{asset('userImages/'. $user->image)}}" alt="{{ $user->image}}" style="width:40px;">
                    <input type="file" class="form-control" name="image" />
                    <input type="password" placeholder="Enter  Password" name="password" class="form-control card-body" />
                    <input type="password" placeholder="Confrim  Password" name="password_confirmation" class="form-control card-body" />
                    <input type="text" value="{{ $user->address }}" name="address" class="form-control card-body" />
                    <input type="text" value="{{ $user->phone }}" name="phone" class="form-control card-body" />
                    <select name="roles[]" id="">
                        @foreach($roles as $role)
                        <option value="{{$role->id}}" {{$user->roles->contains($role->id) ? "selected" : ""}}>{{$role->name}}</option>
                        @endforeach
                    </select>
                    <div class="card-body">
                        <div class="form-check form-switch">
                            <label for="status" class="form-check-label">Active or Inactive</label>
                            <input type="checkbox" class="form-check-input" name="status" {{$user->status == 1 ? "checked" : ""}} />

                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection