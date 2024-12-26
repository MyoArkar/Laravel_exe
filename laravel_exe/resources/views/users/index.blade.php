@extends('layouts.master')
@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <h1>User List</h1>
        <a href="{{ route('users.create') }}" class="btn btn-outline-success mb-4">
            + Create
        </a>
        <table class="table table-bordered">
            <thead>
                <tr>

                    <th class="bg-primary text-white">NAME</th>
                    <th class="bg-primary text-white">Image</th>
                    <th class="bg-primary text-white">Email</th>
                    <th class="bg-primary text-white">Address</th>
                    <th class="bg-primary text-white">Phone</th>
                    <th class="bg-primary text-white">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $data)
                <tr>

                    <th>{{ $data['name'] }}</th>
                    <th>
                        <img src="{{asset('userImages/'. $data->image)}}" alt="{{ $data->image}}" style="width:40px;">
                    </th>
                    <th>{{ $data['email'] }}</th>
                    <th>{{ $data['address'] }}</th>
                    <th>{{ $data['phone'] }}</th>
                    <th class="d-flex">
                        <a href="{{ route('users.edit', ['id' => $data['id']]) }}"
                            class="btn btn-outline-secondary me-2">
                            Edit
                        </a>
                        <form action="{{ route('users.delete', $data->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-danger">Delete</button>
                        </form>
                    </th>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection