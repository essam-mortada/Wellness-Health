<?php
namespace App\Http\Controllers;

use App\Models\order;
use App\Models\orderItems;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PaymobController extends Controller
{
    public function credit() {
        // Retrieve the temporary order from the session
        $order = Session::get('temporary_order');

        if (!$order) {
            return redirect()->route('cart.view')->with('error', 'Order data is missing.');
        }

        $tokens = $this->getToken();
        $paymobOrder = $this->createOrder($tokens, $order);
        $paymentToken = $this->getPaymentToken($paymobOrder, $tokens, $order);
        return Redirect::away('https://accept.paymob.com/api/acceptance/iframes/' . env('PAYMOB_IFRAME_ID') . '?payment_token=' . $paymentToken);
    }

    public function getToken() {
        $response = Http::post('https://accept.paymob.com/api/auth/tokens', [
            'api_key' => env('PAYMOB_API_KEY')
        ]);
        return $response->object()->token;
    }

    public function createOrder($tokens, $order) {
        $data = [
            "auth_token" => $tokens,
            "delivery_needed" => "false",
            "amount_cents" => $order['total_price'] * 100,
            "currency" => "EGP",
        ];
        $response = Http::post('https://accept.paymob.com/api/ecommerce/orders', $data);
        return $response->object();
    }

    public function getPaymentToken($order, $token, $orderData) {
        $billingData = [
            "apartment" => 'NA',
            "email" => $orderData['email'],
            "floor" => 'NA',
            "first_name" => $orderData['first_name'],
            "street" => $orderData['street'],
            "building" => "NA",
            "phone_number" => $orderData['phone'],
            "shipping_method" => "NA",
            "postal_code" => "NA",
            "city" => $orderData['city'],
            "country" => $orderData['country'],
            "last_name" => $orderData['last_name'],
            "state" => "NA"
        ];
        $data = [
            "auth_token" => $token,
            "amount_cents" => $orderData['total_price'] * 100,
            "expiration" => 3600,
            "order_id" => $order->id,
            "billing_data" => $billingData,
            "currency" => "EGP",
            "integration_id" => env('PAYMOB_INTEGRATION_ID')
        ];
        $response = Http::post('https://accept.paymob.com/api/acceptance/payment_keys', $data);
        return $response->object()->token;
    }

    public function callback(Request $request) {
        $data = $request->all();
        ksort($data);
        $hmac = $data['hmac'];
        $array = [
            'amount_cents',
            'created_at',
            'currency',
            'error_occured',
            'has_parent_transaction',
            'id',
            'integration_id',
            'is_3d_secure',
            'is_auth',
            'is_capture',
            'is_refunded',
            'is_standalone_payment',
            'is_voided',
            'order',
            'owner',
            'pending',
            'source_data_pan',
            'source_data_sub_type',
            'source_data_type',
            'success',
        ];
        $connectedString = '';
        foreach ($data as $key => $element) {
            if (in_array($key, $array)) {
                $connectedString .= $element;
            }
        }
        $secret = env('PAYMOB_HMAC');
        $hased = hash_hmac('sha512', $connectedString, $secret);
        if ($hased == $hmac) {
            $status = $data['success'];
            if ($status == "true") {
               $temporaryOrder = Session::get('temporary_order');

                // Save the order and order items to the database
                $order = new order();
                $order->first_name = $temporaryOrder['first_name'];
                $order->last_name = $temporaryOrder['last_name'];
                $order->email = $temporaryOrder['email'];
                $order->country = $temporaryOrder['country'];
                $order->city = $temporaryOrder['city'];
                $order->street = $temporaryOrder['street'];
                $order->phone = $temporaryOrder['phone'];
                $order->delivery = $temporaryOrder['delivery'];
                $order->total_price = $temporaryOrder['total_price'];
                $order->payment = $temporaryOrder['payment'];
                $order->status = 'pending';
                $order->save();

                $cart = Session::get('cart', []);
                foreach ($cart as $id => $details) {
                    orderItems::create([
                        'order_id' => $order->id,
                        'product_id' => $id,
                        'quantity' => $details['quantity'],
                        'price' => $details['price']
                    ]);

                    $product = product::find($id);
                    $product->quantity -= $details['quantity'];
                    $product->save();
                }

                // Clear the session data
                Session::forget('cart');
                Session::forget('temporary_order');
                return view('payment-success');
            } else {
                return redirect('/checkout')->with('error', 'Something Went Wrong Please Try Again');
            }
        } else {
            return redirect('/checkout')->with('error', 'Something Went Wrong Please Try Again');
        }
    }
}
