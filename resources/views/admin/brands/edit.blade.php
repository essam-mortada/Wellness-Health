@include('admin.layouts.header')
<div class="container">
    <h2>Edit Brand</h2>

    <form action="{{ route('brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')



        <div class="mb-3">
            <label class="form-label">Brand Logo</label>
            <input type="file" name="logo" class="form-control">
            <img src="{{ asset('public/brands/' . $brand->logo) }}" width="80" class="mt-2">
        </div>

        <button type="submit" class="btn btn-success">Update Brand</button>
    </form>
</div>
@include('admin.layouts.scripts')
