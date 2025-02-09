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
                    <select class="form-control" required name="category" id="category">
                        <option selected disabled value="">Select a category</option>
                        <option value="herbs" {{ old('category', $product->category) == 'herbs' ? 'selected' : '' }}>Herbs</option>
                        <option value="skin care" {{ old('category', $product->category) == 'skin care' ? 'selected' : '' }}>Skin Care</option>
                        <option value="hair care" {{ old('category', $product->category) == 'hair care' ? 'selected' : '' }}>Hair Care</option>
                        <option value="nutrition" {{ old('category', $product->category) == 'nutrition' ? 'selected' : '' }}>Nutrition</option>
                        <option value="vitamins" {{ old('category', $product->category) == 'vitamins' ? 'selected' : '' }}>Vitamins</option>
                        <option value="weight loss supplements" {{ old('category', $product->category) == 'weight loss supplements' ? 'selected' : '' }}>weight loss supplements</option>
                        <option value="weight gain supplements" {{ old('category', $product->category) == 'weight gain supplements' ? 'selected' : '' }}>weight loss supplements</option>
                    </select>
                    @error('category')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="type">Product type:</label>
                    <select class="form-control" required name="type" id="type">
                        <option selected disabled value="">Select a type</option>
                        <option value="product" {{ old('type', $product->type) == 'product' ? 'selected' : '' }}>Product</option>
                        <option value="offer" {{ old('type', $product->type) == 'offer' ? 'selected' : '' }}>Offer</option>
                    </select>
                </div>

                    <div class="form-group">
                        <label for="brand_id">Brand</label>
                        <select name="brand_id" id="brand_id" class="form-control">
                            <option value="">-- No Brand --</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}"
                                    {{ old('brand_id', $product->brand_id ?? '') == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
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
