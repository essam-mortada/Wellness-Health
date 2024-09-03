<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class cartController extends Controller
{
    public function addToCart(Request $request, $productId)
    {
        $product = product::findOrFail($productId);
        if ($product->quantity == 0) {
            return response()->json(['success' => false, 'message' => 'no enough stock for product'.$product->name]);

        }

        $cart = Session::get('cart', []);

            if ($product->quantity < $product['quantity']) {
                return response()->json(['success' => false, 'message' => 'no enough stock for product'.$product->name]);
            }


        if($request->quantity){
            $quantity = $request->quantity;
        }else{
            $quantity = 1;
        }

        if(isset($cart[$productId])) {
            $cart[$productId]['quantity']+= $quantity;
        } else {
            $cart[$productId] = [
                "name" => $product->name,
                "description" =>$product->description ,
                "quantity" => $quantity,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        Session::put('cart', $cart);
        return response()->json(['success' => true, 'message' => 'Product added to cart!']);
    }

    public function viewCart()
    {
        $cart = Session::get('cart', []);
        $total=0;
        foreach ($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }
        return view('cart', compact('cart','total'));
    }

    public function removeFromCart($productId)
    {
        $cart = Session::get('cart', []);

        if(isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put('cart', $cart);
        }

        return response()->json(['success' => true, 'message' => 'Product removed from cart!']);
    }

    public function updateCart(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = Session::get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
           Session::put('cart', $cart);
           Session::flash('success', 'Cart updated successfully');
        }
        return redirect()->back()->with('success','Product qunatity updated successfully');
    }
}
