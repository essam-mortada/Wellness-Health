<!-- resources/views/admin/products/show.blade.php -->

@include('admin.layouts.header')

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <h1>Product Details</h1>
                <a href="{{ route('products.index') }}" class="btn btn-success">Back to Products</a>
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
                    <div class="col-md-6 mb-5 mt-3 text-center">
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary  mr-2">Edit</a>

                    <form action="{{ route('products.destroy', $product->id) }}" method="post" style="display: inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger  ">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('admin.layouts.scripts')
