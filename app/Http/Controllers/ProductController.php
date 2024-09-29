<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products= product::paginate(5);

        return view('admin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         //
         $request->validate([
            'name'=>'required|string',
            'price'=>'required|integer',
            'description'=>'required|string',
            'image'=>'image|mimes:jpeg,png,jpg,svg|max:2048',
            'category'=>'required|in:vitamins,skin care,hair care,herbs,nutrition,weight loss supplements,weight gain supplements',
            'type'=>'required|in:product,offer',
            'quantity'=>'required|integer|min:0'
            ]);


            $product = new product();
            $product->name = $request->name;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->quantity = $request->quantity;
            $product->category= $request->category;
            $product->type= $request->type;

            if ($request->hasFile('image')) {
                $imageName = time().rand(0,500).'.'.$request->image->extension();
                $request->image->move(public_path('products_uploads'), $imageName);
                $product->image = $imageName;
            }else{
                $product->image = 'default.png';
            }
            $product->save();
            return redirect()->route('products.index')->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        if (!$product) {
            return view('error-404');
        }
        $reviews = $product->reviews()->latest()->paginate(10);
        $averageRating = round($product->reviews()->avg('rating'));
        $products=product::where('id', '!=', $product->id)->paginate(4);

        return view('product',compact('product','products','reviews','averageRating'));

    }

    public function showProductAdmin(product $product)
    {
        return view('admin.products.show',compact('product'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product $product)
    {
        return view('admin.products.edit',compact('product'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, product $product)
    {
        $request->validate([
            'name'=>'required|string',
            'price'=>'required|integer',
            'description'=>'required|string',
            'image'=>'image|mimes:jpeg,png,jpg,svg|max:2048',
            'category'=>'required|in:vitamins,skin care,hair care,herbs,nutrition,weight loss supplements,weight gain supplements',
            'type'=>'required|in:product,offer',
            'quantity'=>'required|integer|min:0'
        ]);
        if($request->hasFile('image')){
        unlink(public_path('products_uploads/'.$product->image));
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('products_uploads'), $imageName);
        $product->image = $imageName;
        }
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->category= $request->category;
        $product->type= $request->type;
        $product->quantity = $request->quantity;
        $product->save();
        return redirect()->route('products.index')->with('success','Product updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product)
    {

        if ($product->image != 'default.png') {
            unlink(public_path('products_uploads/'.$product->image));

        }
        $product->delete();
        return redirect()->route('products.index')->with('success','Product deleted successfully.');
    }

    public function filterByCategory(Request $request)
    {
        $category = $request->input('category');

        if ($category == 'all') {
            $products = Product::where('type','product')->all();
            $offers = product::where('type','offer')->all();
        }else{
        $products = Product::where('type','product')
        ->where('category', $category)->all();
        $offers = Product::where('type','offer')
        ->where('category', $category )->all();

        }
        return view('shop',compact('products','offers'));
    }


}
