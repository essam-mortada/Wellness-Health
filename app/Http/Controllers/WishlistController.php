<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlistItems = Auth::user()->wishlistProducts;
        return view('wishlist', compact('wishlistItems'));
    }

    // Add a product to the wishlist
    public function add(Product $product)
    {
        $user = Auth::user();

        // Check if the product is already in the wishlist
        if (!$user->wishlistProducts->contains($product)) {
            Wishlist::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
            ]);
            return redirect()->back()->with('success', 'Product added to wishlist!');
        }

        return redirect()->back()->with('error', 'Product is already in your wishlist.');
    }

    // Remove a product from the wishlist
    public function remove(product $product)
    {
        $user = Auth::user();

        // Find and delete the wishlist item
        Wishlist::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->delete();

        return redirect()->back()->with('success', 'Product removed from wishlist!');
    }
}
