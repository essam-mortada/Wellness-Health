<?php

namespace App\Http\Controllers;

use App\Models\review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(){
        $reviews = review::latest()->paginate(5);
        return view('admin.reviews.index', compact('reviews'));
    }
    public function store(Request $request, $productId)
    {
        $request->validate([
            'review' => 'required|string|max:1000',
            'rating' => 'required|integer|between:1,5',
            'name'=>'required|string'
        ]);


        $review = new review();
        $review->review = $request->review;
        $review->rating = $request->rating;
        $review->product_id = $productId;
        $review->name = $request->name;
        $review->save();

        return redirect()->back()->with('success', 'Review submitted successfully');
    }
    public function destroy(review $review){
        $review->delete();
        return redirect()->back()->with('success', 'Review deleted successfully');
    }


}
