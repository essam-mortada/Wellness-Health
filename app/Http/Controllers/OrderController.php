<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\orderItems;
use App\Models\product;
use App\Models\promoCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
        // Validate the order form input
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|email',
            'country' => 'required|string',
            'payment' => 'required',
            'delivery'=>'required',
            'phone' => 'required|regex:/^01[0-9]{9}$/',
            'city' => 'required|string',
            'floor' => 'required|numeric',
            'street' => 'required|string',
            'terms' => 'accepted',
        ]);

        // Get the cart from the session
        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }

        // Validate stock levels for each product
        foreach ($cart as $id => $details) {
            $product = product::find($id);
            if ($product->quantity < $details['quantity']) {
                return redirect()->back()->with('error', 'Not enough stock for product ' . $product->name);
            }
        }

        // Calculate total price
        $total = 0;
        foreach ($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }
        // Check if a discount is applied and retrieve it from the session
        $discount = Session::get('promo_discount', 0);
        $total_price_after_discount = max(0, $total - $discount);

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
            'total_price' => $total_price_after_discount + $request->delivery,
            'status' => 'pending'
        ];

        // Store the temporary order in the session
        Session::put('temporary_order', $order);

        // Check if the session data is correctly set
        $tempOrder = Session::get('temporary_order');
        if (!$tempOrder) {
            return redirect()->back()->with('error', 'Failed to store order data in session.');
        }
        // Check if OTP is already verified
        if (Session::has('otp_verified') && Session::get('otp_verified') === true) {
            // Proceed with order creation since OTP was already verified
            if ($request->payment == "online payment") {
                return response()->view('payment', [
                    'route' => route('credit'),
                    'csrf_token' => csrf_token()
                ]);
            } else {
            // Create a new order
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
            $order->total_price = $total_price_after_discount + $request->delivery;
            $order->payment = $request->payment;
            $order->status = 'pending';
            $order->save();

             // Increment promo code usage only if the promo code was applied and order is confirmed
             if ($discount > 0) {
                $promoCode = promoCode::where('code', Session::get('promo_code'))->first();
                if ($promoCode && $promoCode->isValid() && $promoCode->hasRemainingUsage()) {
                    $promoCode->incrementUsage();
                }
            }

            // Store each product in the order items
            foreach ($cart as $id => $details) {
                OrderItems::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'quantity' => $details['quantity'],
                    'price' => $details['price']
                ]);

                // Update the product stock
                $product = Product::find($id);
                $product->quantity -= $details['quantity'];
                $product->save();


                $products[] = [
                    'name' => $product->name,
                    'quantity' => $details['quantity'],
                    'price' => $details['price'],
                    'subtotal' => $details['price'] * $details['quantity'],
                ];
            }

            // Clear the session data
            Session::forget('promo_discount');
            Session::forget('total_after_discount');
            Session::forget('cart');
            Session::forget('otp_verified');

            $orderDetails = [
                'id' => $order->id,
                'first_name' => $order->first_name,
                'last_name' => $order->last_name,
                'email' => $order->email,
                'phone' => $order->phone,
                'country' => $order->country,
                'city' => $order->city,
                'street' => $order->street,
                'floor' => $order->floor,
                'delivery' => $order->delivery,
                'payment' => $order->payment,
                'total_price' => $order->total_price,
                'discount' => $discount,
            ];

            try {
                Mail::send('new-order-confirmation', ['order' => $orderDetails,'products'=>$products,'discount'=>$discount], function ($message) use ($request) {
                    $message->to('help@wellnezmart.net')
                        ->subject('New Order Confirmed!');
                });

            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Failed to send order confirmation: ' . $e->getMessage());
            }

            return redirect()->route('home')->with('done', "Order has been placed successfully!");
        }
    }
        // Generate and send OTP if not yet verified
        $otp = rand(100000, 999999);
        Session::put('otp', $otp);
        Session::put('temporary_order', $request->all());

        try {
            // Send OTP via email using the created view
            Mail::send('otp', ['otp' => $otp], function ($message) use ($request) {
                $message->to($request->email)
                    ->subject('Your OTP for Order Confirmation');
            });

            // Redirect to OTP verification view
            return redirect()->route('verifyOTP');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to send OTP: ' . $e->getMessage());
        }
    }
    public function showOTPForm(){
        return view('verify-otp');
    }

    // Method to handle OTP verification
    public function verifyOTP(Request $request)
    {
        // Validate the OTP input
        $request->validate([
            'otp' => 'required|numeric'
        ]);

        // Retrieve the OTP stored in the session
        $sessionOtp = Session::get('otp');

        if ($request->otp == $sessionOtp) {

            // OTP is correct, mark it as verified
            Session::put('otp_verified', true);

            // Redirect to the order placement route after OTP verification
            return $this->store(new Request(Session::get('temporary_order')));
        } else {
            // OTP is incorrect, show an error
            return redirect()->back()->withErrors(['otp' => 'Invalid OTP!'])->withInput();
        }
    }

    public function resendOTP(Request $request)
    {
        // Check if the user has a temporary order in the session
        if (!Session::has('temporary_order')) {
            return redirect()->route('home')->with('error', 'No order found to resend OTP.');
        }

        // Retrieve the temporary order data
        $temporaryOrder = Session::get('temporary_order');

        // Generate a new OTP
        $otp = rand(100000, 999999);
        Session::put('otp', $otp); // Store the new OTP in the session

        // Send the OTP to the user's email
        try {
            Mail::send('otp', ['otp' => $otp], function ($message) use ($request) {
                $message->to($request->email)
                    ->subject('Your OTP for Order Confirmation');
            });

            return view('verify-otp');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to send OTP: ' . $e->getMessage());
        }
    }



    public function show($orderId)
    {
        $order = Order::with('orderItems.product')->findOrFail($orderId);

        return view('admin.orders.show', compact('order'));
    }

    public function out_for_delivery(Order $order)
    {
        $order->status = 'out for delivery';
        $order->save();
        return redirect()->back()->with('success', 'Status updated successfully');
    }

    public function delivered(Order $order)
    {
        $order->status = 'delivered';
        $order->save();
        return redirect()->back()->with('success', 'Status updated successfully');
    }

    public function deliveredOrders()
    {
        $orders = Order::where('status', 'delivered')->paginate(5);
        return view('admin.orders.index', compact('orders'));
    }

    public function out_for_delivery_orders()
    {
        $orders = Order::where('status', 'out for delivery')->paginate(5);
        return view('admin.orders.index', compact('orders'));
    }

    public function pendingOrders()
    {
        $orders = Order::where('status', 'pending')->paginate(5);
        return view('admin.orders.index', compact('orders'));
    }
}
