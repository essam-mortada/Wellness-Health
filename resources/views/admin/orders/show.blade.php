<!-- resources/views/admin/products/show.blade.php -->

@include('admin.layouts.header')

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <h4>order Details</h4>
                <a href="{{ route('orders.index') }}" class="btn btn-success" >Back to Orders</a>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <h2>{{ $order->first_name.' '. $order->last_name }}</h2>
                        <p><strong>Price:</strong> {{ $order->total_price }}</p>
                        <p><strong>Address:</strong> {{ $order->country.','.$order->city.','.$order->street }}</p>
                        <p><strong>Phone:</strong> {{ $order->phone }}</p>
                        <p><strong>E-mail:</strong> {{ $order->email }}</p>
                        <p><strong>Date:</strong> {{ $order->created_at }}</p>
                        <p><strong>Payment:</strong> {{ $order->payment }}</p>
                        <p><strong>Delivery:</strong> {{ $order->status }}</p>
                    </div>
                </div>
                <h2 class="">Order products</h2>
                <div class="col-8 ">


                            @foreach($order->orderItems as $item)

                                    <p><strong>Product: </strong>{{ $item->product->name }}</p>
                                    <p><strong>Quantity: </strong>{{ $item->quantity }}</p>
                                    <hr>


                            @endforeach

                    </div>
                    <div class="row">
                    <form class="mr-3 ml-3" action="{{route('orders.delivery',$order->id)}}" method="POST">
                        @csrf
                        <button class="btn btn-info" type="submit">out for delivery</button>
                    </form>
                    <form action="{{route('orders.delivered',$order->id)}}" method="POST">
                        @csrf
                        <button class="btn btn-warning" type="submit">delivered</button>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.layouts.scripts')
