<!-- resources/views/admin/products/index.blade.php -->

@include('admin.layouts.header')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>orders</h1>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>client Name</th>
                            <th>total Price</th>
                            <th>address</th>
                            <th>date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->first_name.' '. $order->last_name }}</td>
                                <td>{{ $order->total_price }}</td>
                                <td>{{ $order->country.','.$order->city.','.$order->street }}</td>
                                <td>
                                  {{$order->created_at}}
                                </td>
                                <td>
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info">View</a>
                                  
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $orders->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
