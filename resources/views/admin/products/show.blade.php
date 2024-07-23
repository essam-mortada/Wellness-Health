<!-- resources/views/admin/products/show.blade.php -->

@include('admin.layouts.header')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Product Details</h1>
                <a href="{{ route('products.index') }}" class="btn btn-default">Back to Products</a>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <h2>{{ $product->name }}</h2>
                        <p><strong>Price:</strong> {{ $product->price }}</p>
                        <p><strong>Description:</strong> {{ $product->description }}</p>
                        <p><strong>Quantity:</strong> {{ $product->quantity }}</p>
                    </div>
                    <div class="col-md-6">
                        @if($product->image!= 'default.png')
                            <img src="{{ asset('products_uploads/'.$product->image) }}" width="200" height="200">
                        @else
                            <img src="{{ asset('products_uploads/default.png') }}" width="200" height="200">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
