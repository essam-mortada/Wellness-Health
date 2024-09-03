
@include('admin.layouts.header')

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <h1>Blog Details</h1>
                <a href="{{ route('blogs.index') }}" class="btn btn-success">Back to Blogs</a>
                <hr>
                <div class="row">
                    <div class="col-md-8">
                        <h2>{{ $blog->title }}</h2>
                        <p><strong>summary:</strong> {{ $blog->summary }}</p>
                        <p><strong>content:</strong> {{ $blog->content }}</p>
                    </div>
                    <div class="col-md-4 text-center">
                        @if($blog->image!= 'default.png')
                            <img src="{{ asset('blogs_uploads/'.$blog->image) }}" width="200" height="200">
                        @else
                            <img src="{{ asset('blogs_uploads/default.png') }}" width="200" height="200">
                        @endif
                    </div>
                    <div class="col-md-6 mb-5 mt-3 text-center">
                        <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-primary  mr-2">Edit</a>

                    <form action="{{ route('blogs.destroy', $blog->id) }}" method="post" style="display: inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger  ">Delete</button>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.layouts.scripts')
