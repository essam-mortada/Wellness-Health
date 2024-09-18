<!-- create.blade.php -->
@include('admin.layouts.header')

<div class="container mt-5">
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-sm-12">
            <h4>Add New Product</h4>

            <form method="POST" enctype="multipart/form-data" action="{{ route('products.store') }}">
                @csrf

                <div class="form-group">
                    <label for="name">Product Name:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="description">Product Description:</label>
                    <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label for="price">Product Price:</label>
                    <input type="number" id="price" name="price" class="form-control" step="0.01" required>
                </div>

                <div class="form-group">
                    <label for="category">Product category:</label>
                    <select class="form-control" required name="category" id="">
                        <option selected disabled value="">select a category</option>
                        <option value="herbs">herbs</option>
                        <option value="body care">body care</option>
                        <option value="nutrition">nutrition</option>
                        <option value="vitamins">vitamins</option>
                        <option value="supplements">supplements</option>
                    </select>
              </div>

                <div class="form-group">
                    <label for="image">Product Image:</label>
                    <input type="file" id="image" name="image" class="form-control-file">
                </div>

                <div class="form-group">
                    <label for="quantity">Product Quantity:</label>
                    <input type="number" id="quantity" name="quantity" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Create Product</button>
            </form>

            @if ($errors->any())
                <div class="alert alert-danger mt-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>

@include('admin.layouts.scripts')
