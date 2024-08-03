<!-- resources/views/admin/products/edit.blade.php -->

@include('admin.layouts.header')

<div class="container mt-5">
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <h1>Edit blog: {{ $blog->title }}</h1>
            <form action="{{ route('blogs.update', $blog->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="title">title:</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $blog->title }}" required>
                </div>
                
                <div class="form-group">
                    <label for="summary">summary:</label>
                    <input type="text" class="form-control" id="summary" name="summary" value="{{ $blog->summary }}" required>
                </div>
                
                <div class="form-group">
                    <label for="description">content:</label>
                    <textarea class="form-control" id="content" name="content" required>{{ $blog->content }}</textarea>
                </div>
                
                <div class="form-group">
                    <label for="image">Image:</label>
                    <input type="file" class="form-control" id="image" name="image">
                    @if($blog->image != 'default.png')
                        <img src="{{ asset('blogs_uploads/'.$blog->image) }}" width="50" height="50">
                    @else
                        <img src="{{ asset('blogs_uploads/default.png') }}" width="50" height="50">
                    @endif
                </div>
                
                <button type="submit" class="btn btn-primary">Update blog</button>
                <a href="{{ route('blogs.index') }}" class="btn btn-secondary">Back to blogs List</a>
            </form>
        </div>
    </div>
</div>

@include('admin.layouts.scripts')
