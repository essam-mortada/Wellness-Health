
@include('admin.layouts.header')

<div class="container mt-5">
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap">
                <h1>products Reviews</h1>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>product</th>
                            <th>Review</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reviews as $review)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $review->name }}</td>
                                <td>{{ $review->product->name }}</td>
                                <td>{{ $review->review }}</td>
                                <td>{{ $review->created_at }}</td>

                                <td>
                                    <form action="{{ route('reviews.destroy', $review->id) }}" method="post" style="display: inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm mt-2">Delete</button>
                                    </form>                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">No reviews found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $reviews->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

@include('admin.layouts.scripts')
