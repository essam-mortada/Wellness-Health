<?php

namespace App\Http\Controllers;

use App\Models\blog;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class homeController extends Controller
{
    public function ShowHome(){
        if(Auth::user()){
            return redirect()->route('admin.home');
        }
        $products= product::latest()->paginate(8);
        return view('home',compact('products'));
    }

    public function ShowAbout(){

        return view('about');
    }
    public function ShowPayment(){

        return view('payment-success');
    }
    public function ShowBlog(){
        $blogs= blog::all();
        $recentBlogs= blog::orderBy('created_at','desc')->paginate(3);
        return view('blog', compact('blogs','recentBlogs'));
    }
    public function ShowContact(){

        return view('contact');
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
