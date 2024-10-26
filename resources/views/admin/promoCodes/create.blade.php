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
            <h4>Add New promo code</h4>

            <form method="POST" enctype="multipart/form-data" action="{{ route('promoCodes.store') }}">
                @csrf

                <div class="form-group">
                    <label for="title">code:</label>
                    <input type="text" id="code" name="code" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="price">Discount:</label>
                    <input type="number" id="discount" name="discount" class="form-control" step="0.01" required>
                </div>

                <div class="form-group">
                    <label for="content">Expires at:</label>
                    <input type="date" id="expires_at" name="expires_at" class="form-control"  required></input>
                </div>

                <div class="form-group">
                    <label for="usage_limit">usage limit:</label>
                    <input type="number" id="usage_limit" name="usage_limit" class="form-control" required step="0.01" >
                </div>


                <button type="submit" class="btn btn-primary">Create promo code</button>
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
