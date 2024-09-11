<!-- create.blade.php -->
@include('admin.layouts.header')

<div class="container mt-5">
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-sm-12">
            <h4>Add New blog</h4>

            <form method="POST" enctype="multipart/form-data" action="{{ route('blogs.store') }}">
                @csrf

                <div class="form-group">
                    <label for="title">blog title:</label>
                    <input type="text" id="title" name="title" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="price">blog summary:</label>
                    <input type="text" id="summary" name="summary" class="form-control" step="0.01" required>
                </div>

                <div class="form-group">
                    <label for="content">blog content:</label>
                    <textarea id="content" name="content" class="form-control" rows="4" required></textarea>
                </div>



                <div class="form-group">
                    <label for="image">blog Image:</label>
                    <input type="file" id="image" name="image" class="form-control-file">
                </div>


                <button type="submit" class="btn btn-primary">Create blog</button>
            </form>

            @if ($errors->any())
                <div class="alert alert-danger mt-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>

@include('admin.layouts.scripts')
