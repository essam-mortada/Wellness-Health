<!-- resources/views/admin/products/index.blade.php -->

@include('admin.layouts.header')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Products</h1>
                <a href="{{ route('products.create') }}" class="btn btn-primary">Create New Product</a>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->description }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>
                                    @if($product->image!= 'default.png')
                                        <img src="{{ asset('products_uploads/'.$product->image) }}" width="50" height="50">
                                    @else
                                        <img src="{{ asset('products_uploads/default.png') }}" width="50" height="50">
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">View</a>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="post" style="display: inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
