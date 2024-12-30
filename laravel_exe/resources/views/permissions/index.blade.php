@extends('layouts.master')
@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <h1>Permission List</h1>
        <a href="{{ route('permissions.create') }}" class="btn btn-outline-success mb-4">
            + Create
        </a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="bg-primary text-white">Id</th>
                    <th class="bg-primary text-white">NAME</th>
                    <th class="bg-primary text-white">ACTION</th>
                   
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $data)
                <tr>
                    <th>{{ $data['id'] }}</th>
                    <th>{{ $data['name'] }}</th>
                    <th class="d-flex">
                        <a href="{{ route('permissions.edit', ['id' => $data['id']]) }}"
                            class="btn btn-outline-secondary me-2">
                            Edit
                        </a>
                        <form action="{{ route('permissions.delete', $data->id) }}" method="POST">
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