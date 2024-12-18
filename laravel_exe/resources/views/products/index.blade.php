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
  <div class="container mt-4">
    <a href="{{ route('products.create') }}" class="btn btn-primary">Create</a>
    <table class="table table-border table-striped mt-3">
      <thead class="table-dark">
        <tr>
          <th class="text-white">Name</th>
          <th class="text-white">Description</th>
          <th class="text-white">Price</th>
          <th class="text-white text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($products as $product)
        <tr>
          <th>{{$product['name']}}</th>
          <th>{{$product['description']}}</th>
          <th>{{$product['price']}}</th>
          <th class="d-flex justify-content-center">
            <a href="{{ route('products.edit', ['id' => $product['id']]) }}"
              class="btn btn-outline-secondary me-2">Edit</a>
            <form action="{{ route('products.delete', $product->id) }}" method="POST">
              @csrf
              <button class="btn btn-danger">Delete</button>
            </form>
          </th>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
  </script>
</body>

</html>