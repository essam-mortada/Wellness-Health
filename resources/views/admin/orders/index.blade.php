<!-- resources/views/admin/products/index.blade.php -->

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
                <h3>Orders</h3>
                <div class="btn-group mb-3" role="group">
                    <a class="btn btn-success btn-sm mr-2 mb-2" href="{{route('orders.index')}}">All</a>
                    <a class="btn btn-warning btn-sm mr-2 mb-2" href="{{route('orders.deliveredOrders')}}">Delivered</a>
                    <a class="btn btn-info btn-sm mr-2 mb-2" href="{{route('orders.out_for_delivery_orders')}}">Out For Delivery</a>
                    <a class="btn btn-dark btn-sm mr-2 mb-2" href="{{route('orders.pendingOrders')}}">Pending</a>
                </div>
            </div>


            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Client Name</th>
                            <th>Total Price</th>
                            <th>Address</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->first_name . ' ' . $order->last_name }}</td>
                                <td>{{ $order->total_price }}</td>
                                <td>{{ $order->country . ',' . $order->city . ',' . $order->street }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">View</a>
                                    <form action="{{ route('orders.destroy', $order->id) }}" method="post" style="display: inline">
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
                <div class="d-flex justify-content-center">
                    {{ $orders->links('pagination::bootstrap-5') }}
                </div>
            </div>

        </div>
    </div>
</div>

@include('admin.layouts.scripts')
