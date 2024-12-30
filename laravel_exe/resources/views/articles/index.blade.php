@extends('layouts.master')
@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <h1>Article List</h1>
        @can('articleCreate')
        <a href="{{ route('articles.create') }}" class="btn btn-outline-success mb-4">
            + Create
        </a>
        @endcan
        <table class="table table-bordered">
            <thead>
                <tr>

                    <th class="bg-primary text-white">NAME</th>
                    <th class="bg-primary text-white">Description</th>
                    <th class="bg-primary text-white">Image</th>
                    <th class="bg-primary text-white">Category</th>
                    <th class="bg-primary text-white">Status</th>
                    @can('articleEdit,articleDelete')
                    <th class="bg-primary text-white">ACTION</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $data)
                <tr>

                    <th>{{ $data['name'] }}</th>
                    <th>{{ $data['description'] }}</th>
                    <th>
                        <img src="{{asset('ArticleImages/'. $data->image)}}" alt="{{ $data->image}}" style="width:40px;">
                    </th>
                    <th>
                        {{$data['category']['name']}}
                    </th>
                    <th>
                        @if($data['status'] == 1)
                        <span class="text-success">Active</span>
                        @else
                        <span class="text-danger">Suspended</span>
                        @endif
                    </th>
                    @can('articleEdit,articleDelete')
                    <th class="d-flex">
                        <a href="{{ route('articles.edit', ['id' => $data['id']]) }}"
                            class="btn btn-outline-secondary me-2">
                            Edit
                        </a>
                        <form action="{{ route('articles.delete', $data->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-danger">Delete</button>
                        </form>
                    </th>
                    @endcan
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection