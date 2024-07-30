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
            'phone' => 'required|string|numeric',
            'city' => 'required|string',
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

        $order = new Order();
        $order->first_name = $request->first_name;
        $order->last_name = $request->last_name;
        $order->email = $request->email;
        $order->country = $request->country;
        $order->city = $request->city;
        $order->street = $request->street;
        $order->phone = $request->phone;
        $order->delivery = 50;
        $order->payment = $request->payment;
        $order->total_price = $total+ $order->delivery;
        $order->status = 'pending';
        $order->save();

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

        Session::forget('cart');

        return redirect()->route('cart.view')->with('success', 'Order has been placed successfully!');
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
        return redirect()->back();

    }

    public function delivered( order $order)
    {
        $order->status='delivered';
        $order->save();
        return redirect()->back();
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
