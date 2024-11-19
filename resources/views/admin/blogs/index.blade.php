
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
                <h1>blogs</h1>
                <a href="{{ route('blogs.create') }}" class="btn btn-primary mt-2 mt-md-0">Add New Blog</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>title</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($blogs as $blog)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $blog->title }}</td>
                                <td>
                                    @if($blog->image != 'default.png')
                                        <img src="{{ asset('public/blogs_uploads/'.$blog->image) }}" width="100" height="100" class="img-fluid img-thumbnail">
                                    @else
                                        <img src="{{ asset('public/blogs_uploads/default.png') }}" width="100" height="100" class="img-fluid img-thumbnail">
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="blog actions">
                                        <a href="{{ route('blogs.show.admin', $blog->id) }}" class="btn btn-info btn-sm mr-2">View</a>
                                        <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-primary btn-sm mr-2">Edit</a>

                                    </div><br>
                                    <form action="{{ route('blogs.destroy', $blog->id) }}" method="post" style="display: inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm mt-2">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">No orders found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $blogs->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

@include('admin.layouts.scripts')
