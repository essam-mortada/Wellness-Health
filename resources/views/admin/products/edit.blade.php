<!-- resources/views/admin/products/edit.blade.php -->

@include('admin.layouts.header')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Edit Product: {{ $product->name }}</h1>
                <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
                    </div>
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}">
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="description" name="description">{{ $product->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $product->quantity }}">
                    </div>
                    <div class="form-group">
                        <label for="image">Image:</label>
                        <input type="file" class="form-control" id="image" name="image">
                        @if($product->image!= 'default.png')
                            <img src="{{ asset('products_uploads/'.$product->image) }}" width="50" height="50">
                        @else
                            <img src="{{ asset('products_uploads/default.png') }}" width="50" height="50">
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Update Product</button>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to Products List</a>
                </form>
            </div>
        </div>
    </div>
