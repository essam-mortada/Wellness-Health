<!-- resources/views/admin/products/edit.blade.php -->

@include('admin.layouts.header')

<div class="container mt-3">
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <h4>Edit Product: {{ $product->name }}</h4>
            <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>

                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" required>
                    @error('price')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>

                <div class="form-group">
                    <label for="category">Product category:</label>
                    <select class="form-control" required name="category" id="">
                        <option selected disabled value="">select a category</option>
                        <option value="herbs">Herbs</option>
                        <option value="skin care">Skin care</option>
                        <option value="hair care">Hair care</option>
                        <option value="nutrition">Nutrition</option>
                        <option value="vitamins">Vitamins</option>
                        <option value="weight loss supplements">Weight loss supplements</option>
                        <option value="weight gain supplements">Weight gain supplements</option>
                    </select>
                    @error('category')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group">
                <label for="type">Product type:</label>
                <select class="form-control" required name="type" id="">
                    <option selected disabled value="">select a type</option>
                    <option value="product">product</option>
                    <option value="offer">offer</option>

                </select>
                @error('type')
                <span class="text-danger">{{ $message }}</span>
            @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea class="form-control" id="description" name="description" required>{{ $product->description }}</textarea>
                    @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>

                <div class="form-group">
                    <label for="quantity">Quantity:</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $product->quantity }}" required>
                    @error('number')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>

                <div class="form-group">
                    <label for="image">Image:</label>
                    <input type="file" class="form-control" multiple id="image" name="images[]">
                    @error('images.0')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                @error('images')
                <span class="text-danger">{{ $message }}</span>
            @enderror
                </div>

                <div class="form-group">
                    <label for="image">Product Video:</label>
                    <input type="file" class="form-control" name="video" id="video">
                    @error('video')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                </div>


                <button type="submit" class="btn btn-primary">Update Product</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to Products List</a>
            </form>
        </div>
    </div>
</div>

@include('admin.layouts.scripts')
