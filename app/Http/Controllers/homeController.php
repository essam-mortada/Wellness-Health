<?php

namespace App\Http\Controllers;

use App\Models\blog;
use App\Models\Brand;
use App\Models\NewsBar;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class homeController extends Controller
{
    public function getNewsBar(){
        $newsBar = NewsBar::first();
        return $newsBar;
    }
    public function ShowHome(){
        
        $brands = Brand::all();
        $newsBar = $this->getNewsBar();
        $products= product::where('type','product')->latest()->paginate(8);
        $offers = product::where('type','offer')->latest()->paginate(8);
        return view('home',compact('products','offers','newsBar','brands'));
    }

    public function ShowAbout(){
        $newsBar = $this->getNewsBar();
        $products = product::all();
        return view('about',compact('newsBar','products'));
    }
    public function ShowPayment(){
        $newsBar = $this->getNewsBar();
        return view('payment-success','newsBar');
    }
    public function ShowBlog(){
        $blogs= blog::all();
        $newsBar = $this->getNewsBar();
        $recentBlogs= blog::orderBy('created_at','desc')->paginate(3);
        return view('blog', compact('blogs','recentBlogs','newsBar'));
    }
    public function ShowContact(){
        $newsBar = $this->getNewsBar();
        return view('contact',compact('newsBar'));
    }
    public function ShowShop(){
        $newsBar = $this->getNewsBar();
        $offers = product::where('type','offer')->paginate(8);
        $products= product::where('type','product')->paginate(8);
        return view('shop',compact('products','offers','newsBar'));
    }

    public function ShowCheckout(){
        $newsBar = $this->getNewsBar();
        $cart = Session::get('cart', []);
        $delivery = 50;
        if (empty($cart)){
            $delivery=0;
        }
        $total=0;
        foreach ($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        };
        return view('checkout',compact('total','delivery','newsBar'));
    }
}
