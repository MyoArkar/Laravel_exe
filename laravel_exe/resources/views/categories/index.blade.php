@extends('layouts.master')
@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <h1>Category List</h1>
        <a href="{{ route('categories.create') }}" class="btn btn-outline-success mb-4">
            + Create
        </a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="bg-primary text-white">ID</th>
                    <th class="bg-primary text-white">NAME</th>
                    <th class="bg-primary text-white">Image</th>
                    <th class="bg-primary text-white">Status</th>
                    <th class="bg-primary text-white">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $data)
                <tr>
                    <th>{{ $data['id'] }}</th>
                    <th>{{ $data['name'] }}</th>
                    <th>
                        <img src="{{asset('categoryImages/'. $data->image)}}" alt="{{ $data->image}}" style="width:40px;">
                    </th>
                    <th>
                        @if($data['status'] == 1)
                        <span class="text-success">Active</span>
                        @else
                        <span class="text-danger">Suspended</span>
                        @endif
                    </th>
                    <th class="d-flex">
                        <a href="{{ route('categories.edit', ['id' => $data['id']]) }}"
                            class="btn btn-outline-secondary me-2">
                            Edit
                        </a>
                        <form action="{{ route('categories.delete', $data->id) }}" method="POST">
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