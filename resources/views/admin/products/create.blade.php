<!-- create.blade.php -->
@include('admin.layouts.header')
<div class="col-6 m-auto">
  <h1>Create New Product</h1>

  <form method="POST" enctype="multipart/form-data" action="{{ route('products.store') }}">
    @csrf

    <div class="form-group">
      <label for="name">Product Name:</label>
      <input type="text" id="name" name="name" class="form-control" required>
    </div>

    <div class="form-group">
      <label for="description">Product Description:</label>
      <textarea id="description" name="description" class="form-control" required></textarea>
    </div>

    <div class="form-group">
      <label for="price">Product Price:</label>
      <input type="number" id="price" name="price" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="price">Product image:</label>
        <input type="file" id="image" name="image" class="form-control" >
    </div>

    <div class="form-group">
        <label for="quantity">Product quantity:</label>
        <input type="number" id="quantity" name="quantity" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Create Product</button>
  </form>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
</div>
