<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\orderItems;
use App\Models\product;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::with('orderItems.product')->paginate(5);
        return view('admin.orders.index', compact('orders'));
    }




    public function store(Request $request)
{
    $cart = Session::get('cart', []);
    if (empty($cart)) {
        return redirect()->back()->with('error', 'Your cart is empty!');
    }

    $request->validate([
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'email' => 'required|string|email',
        'country' => 'required|string',
        'phone' => 'required|string|numeric|min:11|max:11',
        'city' => 'required|string',
        'floor'=>'required|numeric',
        'street' => 'required|string',
        'terms' => 'accepted',
    ]);

    // Validate stock levels
    foreach ($cart as $id => $details) {
        $product = Product::find($id);
        if ($product->quantity < $details['quantity']) {
            return redirect()->back()->with('error', 'Not enough stock for product ' . $product->name);
        }
    }

    $total = 0;
    foreach ($cart as $id => $details) {
        $total += $details['price'] * $details['quantity'];
    }

    // Create a temporary order array
    $order = [
        'id' => uniqid(),
        'first_name' => strip_tags($request->first_name),
        'last_name' => strip_tags($request->last_name),
        'email' => strip_tags($request->email),
        'country' => strip_tags($request->country),
        'city' => strip_tags($request->city),
        'street' => strip_tags($request->street),
        'phone' => strip_tags($request->phone),
        'floor' => strip_tags($request->floor),
        'delivery' => strip_tags($request->delivery),
        'payment' => strip_tags($request->payment),
        'total_price' => $total + $request->delivery,
        'status' => 'pending'
    ];

    // Store the temporary order in the session
    Session::put('temporary_order', $order);

    // Check if the session data is correctly set
    $tempOrder = Session::get('temporary_order');
    if (!$tempOrder) {
        return redirect()->back()->with('error', 'Failed to store order data in session.');
    }
    if ($request->payment == "online payment") {
        return response()->view('payment', [
            'route' => route('credit'),
            'csrf_token' => csrf_token()
        ]);
    } else {
        // Store the order in the database
        $order = new Order();
        $order->first_name = $request->first_name;
        $order->last_name = $request->last_name;
        $order->email = $request->email;
        $order->country = $request->country;
        $order->city = $request->city;
        $order->street = $request->street;
        $order->floor = $request->floor;
        $order->phone = $request->phone;
        $order->delivery = $request->delivery;
        $order->total_price = $total + $order->delivery;
        $order->payment = $request->payment;
        $order->status = 'pending';
        $order->save();

        $cart = Session::get('cart', []);
        foreach ($cart as $id => $details) {
            OrderItems::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $details['quantity'],
                'price' => $details['price']
            ]);

            $product = Product::find($id);
            $product->quantity -= $details['quantity'];
            $product->save();
        }

        // Clear the session data
        Session::forget('cart');
        return redirect()->route('home')->with('done',"order has been placed successfully!");
    }
}



    public function show($orderId)
    {
        $order = Order::with('orderItems.product')->findOrFail($orderId);

        return view('admin.orders.show', compact('order'));
    }


    public function out_for_delivery( order $order)
    {
        $order->status='out for delivery';
        $order->save();
        return redirect()->back()->with('success','status updated successfully');

    }

    public function delivered( order $order)
    {
        $order->status='delivered';
        $order->save();
        return redirect()->back()->with('success','status updated successfully');
    }

     public function deliveredOrders()
    {
        $orders= order::where('status','delivered')->paginate(5);
        return view('admin.orders.index',compact('orders'));
    }
    public function out_for_delivery_orders()
    {
        $orders= order::where('status','out for delivery')->paginate(5);
        return view('admin.orders.index',compact('orders'));
    }
    public function pendingOrders()
    {
        $orders= order::where('status','pending')->paginate(5);
        return view('admin.orders.index',compact('orders'));
    }
}
