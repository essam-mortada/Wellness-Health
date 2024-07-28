<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class homeController extends Controller
{
    public function ShowHome(){

        $products= product::paginate(4);
        return view('home',compact('products'));
    }

    public function ShowShop(){

        $products= product::paginate(8);
        return view('shop',compact('products'));
    }

    public function ShowCheckout(){

        $cart = Session::get('cart', []);
        $delivery = 50;
        if (empty($cart)){
            $delivery=0;
        }
        $total=0;
        foreach ($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        };
        return view('checkout',compact('total','delivery'));
    }
}
