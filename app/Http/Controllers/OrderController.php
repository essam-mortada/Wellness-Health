<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\orderItems;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('orderItems.product')->paginate(5);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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
        $order->payment = 'done';
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


    /**
     * Display the specified resource.
     */
    public function show($orderId)
    {
        $order = Order::with('orderItems.product')->findOrFail($orderId);

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(order $order)
    {
        //
    }
}
