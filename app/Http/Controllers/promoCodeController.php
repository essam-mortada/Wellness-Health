<?php

namespace App\Http\Controllers;

use App\Models\promoCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class promoCodeController extends Controller
{

    public function applyPromo(Request $request)
    {

        // Validate the promo code input
        $request->validate([
            'promo_code' => 'required|string'
        ]);

        $promoCode = $request->promo_code;

        // Sample code to check promo code validity
        $promo = promoCode::where('code', $promoCode)->first();

        // Check if the promo code exists and is valid via the isValid method
        if ($promo && $promo->isValid() && $promo->hasRemainingUsage()) {
            $discountAmount = $promo->discount;

            // Store the discount in session for use during order checkout
            Session::put('promo_discount', $discountAmount);

            // Calculate the new total after discount
            $cart = Session::get('cart', []);
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }
            $totalAfterDiscount = max(0, $total - $discountAmount);

            // Store discount and updated total in session
            Session::put('promo_code', $request->promo_code);
            Session::put('promo_discount', $discountAmount);
            Session::put('total_after_discount', $totalAfterDiscount);

            return response()->json([
                'success' => true,
                'message' => 'Promo code applied successfully!',
                'totalAfterDiscount' => $totalAfterDiscount,
                'discountAmount' => $discountAmount
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired promo code.'
            ]);
        }
    }

    public function index(){
        $promoCodes = promoCode::latest()->paginate(5);
        return view('admin.promoCodes.index', compact('promoCodes'));
    }

    public function create(){
        return view('admin.promoCodes.create');
    }

    public function store(Request $request){
        $request->validate([
            'code'=>'required|string|unique:promo_codes,code',
            'discount'=>'required|integer',
            'expires_at'=>'required|date',
            'usage_limit'=>'required|integer',
            ]);


            $promoCode = new promoCode();
            $promoCode->code =strip_tags( $request->code);
            $promoCode->discount = strip_tags($request->discount);
            $promoCode->expires_at = strip_tags($request->expires_at);
            $promoCode->usage_limit = strip_tags($request->usage_limit);
            $promoCode->save();
            return redirect()->back()->with('success','promo code added  successfully.');
    }

    public function destroy(promoCode $PromoCode)
    {

        $PromoCode->delete();

        return redirect()->route('promoCodes.index')->with('success','PromoCode deleted successfully.');
    }
}
