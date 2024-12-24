<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>article Edit</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <div class="card mt-4">
            <div class="card-header">
                Edit article
            </div>
            <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body d-flex flex-column gap-4">
                    <input type="text" value="{{ $article->name }}" name="name" class="form-control card-body" />
                    <input type="text" value="{{ $article->description }}" name="description" class="form-control card-body" />
                    <input type="text" value="{{$article->image}}" name="old_image" class="form-control card-body" hidden />
                    <img src="{{asset('articleImages/'. $article->image)}}" alt="{{ $article->image}}" style="width:40px;">
                    <input type="file" class="form-control" name="image" />
                    <select name="category_id" id="">
                        <option value="{{$article->category_id}}">{{$article->category->name}}</option>
                        @foreach($categories as $category)
                        @if($category->id != $article->category_id)
                        <option value="{{$category->id}}">
                            {{$category->name}}
                        </option>
                        @endif
                        @endforeach
                    </select>
                    <div class="card-body">
                        <div class="form-check form-switch">
                            <label for="status" class="form-check-label">Active or Inactive</label>
                            <input type="checkbox" class="form-check-input" name="status" {{$article->status == 1 ? "checked" : ""}} />

                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('articles.index') }}" class="btn btn-secondary">Back</a>
                </div>

            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>

</body>

</html>