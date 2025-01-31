@include('admin.layouts.header')
<div class="container">
    <h2>Add New Brand</h2>

    <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Brand Logo</label>
            <input type="file" name="logo" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Add Brand</button>
    </form>
</div>

@include('admin.layouts.scripts')
