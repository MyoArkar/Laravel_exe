<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Category Edit</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <div class="card mt-4">
            <div class="card-header">
                Edit Category
            </div>
            <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <input type="text" value="{{ $category->name }}" name="name" class="form-control card-body" />
                    <input type="file" class="form-control" name="image"/>
                    <div class="card-body">
                        <div class="form-check form-switch">
                            <label for="status" class="form-check-label">Active or Inactive</label>
                            <input type="checkbox" class="form-check-input" name="status"  {{$category->status == 1 ? "checked" : ""}} />
                            
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>

</body>

</html>