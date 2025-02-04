@include('admin.layouts.header')


<div class="container">
    <h2>Brands</h2>
    <a href="{{ route('brands.create') }}" class="btn btn-primary">Add New Brand</a>

    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif
    <div class="table-responsive">

    <table class="table table-striped">
        <thead>
            <tr>
            </tr>
        </thead>
        <tbody>
            @foreach($brands as $brand)
                <tr>
                    <td>{{ $brand->name }}</td>
                    <td><img src="{{ asset('public/brands/' . $brand->logo) }}" width="80"></td>
                    <td>
                        <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
@include('admin.layouts.scripts')
