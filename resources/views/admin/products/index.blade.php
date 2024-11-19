
@include('admin.layouts.header')

<div class="container mt-5">
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                <h3>Products</h3>
                <a href="{{ route('products.create') }}" class="btn btn-primary mt-2 mt-md-0">Add New Product</a>
                <form method="GET" action="{{ route('products.index') }}">
                    <input type="text" class="form-control" name="search" value="{{ request()->input('search') }}" placeholder="Search products...">
                    <button class="btn btn-primary mt-3" type="submit">Search</button>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>
                                    @if($product->image != 'default.png')
                                        <img src="{{ asset('public/products_uploads/'.$product->image) }}" width="50" height="50" class="img-fluid img-thumbnail">
                                    @else
                                        <img src="{{ asset('public/products_uploads/default.png') }}" width="50" height="50" class="img-fluid img-thumbnail">
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Product actions">
                                        <a href="{{ route('products.show.admin', $product->id) }}" class="btn btn-info btn-sm mr-2">View</a>
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm mr-2">Edit</a>

                                    </div><br>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="post" style="display: inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm mt-2">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">No products found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $products->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

@include('admin.layouts.scripts')
