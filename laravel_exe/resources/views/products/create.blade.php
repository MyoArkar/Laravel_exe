<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    @if ($errors->any())
    <div class="text-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif
    <a href="{{ route('products.index') }}" class="btn btn-primary mt-4">Back</a>
    <div class="card text-center w-75 mx-auto mt-4">
      <div class="card-header">
        Create Product
      </div>
      <div class="card-body">
        <form action="{{route('products.store') }}" method="POST" class="d-flex flex-column row-gap-3" enctype="multipart/form-data">
          @csrf
          <input type="text" placeholder="Enter product name" name="name" class="form-control" />
          <input type="file" class="form-control" name="image">
          <input type="text" placeholder="Enter product description" name="description" class="form-control" />
          <input type="number" placeholder="Enter product Price" name="price" class="form-control" />
          <div class="form-check form-switch">
            <label for="status" class="form-check-label">Active or Inactive</label>
            <input type="checkbox" class="form-check-input" name="status" checked />
          </div>
          <button type="submit" class="btn btn-primary">Create</button>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
  </script>
</body>

</html>