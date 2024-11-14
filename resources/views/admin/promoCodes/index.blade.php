
@include('admin.layouts.header')

<div class="container mt-3">
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap">
                <h1> Promo Codes</h1>
                <a href="{{ route('promoCodes.create') }}" class="btn btn-primary mt-2 mt-md-0">Add New promo code</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Discount</th>
                            <th>Expires at</th>
                            <th>Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($promoCodes as $promoCode)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $promoCode->code }}</td>
                                <td>{{ $promoCode->discount }}</td>
                                <td>{{ $promoCode->expires_at }}</td>
                                <td>{{ $promoCode->type }}</td>

                                <td>
                                    <form action="{{ route('promoCodes.destroy', $promoCode->id) }}" method="post" style="display: inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm mt-2">Delete</button>
                                    </form>                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">No promoCodes found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $promoCodes->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

@include('admin.layouts.scripts')
