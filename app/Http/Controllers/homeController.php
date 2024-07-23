<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

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
}
