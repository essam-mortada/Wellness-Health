<!-- resources/views/admin/products/show.blade.php -->

@include('admin.layouts.header')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>order Details</h1>
                <a href="{{ route('orders.index') }}" class="btn btn-default">Back to Products</a>
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
                </div>
            </div>
        </div>
    </div>
