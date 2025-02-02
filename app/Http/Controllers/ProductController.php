<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\NewsBar;
use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $products = Product::where('name', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%")
                ->paginate(5)
                ->appends(['search' => $search]);
        } else {
            $products = Product::paginate(5);
        }

        return view('admin.products.index', compact('products', 'search'));
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
            'name' => 'required|string',
            'price' => 'required|integer',
            'description' => 'required|string',
            'images.*'=>'image|mimes:jpeg,png,jpg,svg|max:2048',
            'category' => 'required|in:vitamins,skin care,hair care,herbs,nutrition,weight loss supplements,weight gain supplements',
            'type' => 'required|in:product,offer',
            'quantity' => 'required|integer|min:0'
        ]);


        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->category = $request->category;
        $product->type = $request->type;
        $product->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time().rand(0,500).'.'.$image->extension();
                 $image->move(public_path('products_uploads'), $imageName);

                Image::create([
                    'product_id' => $product->id,
                    'image_path' => $imageName,
                ]);
            }
        }else{
            $product->image = 'default.png';
        }
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show( $product)
    {
        $product = Product::with('images')->findOrFail($product);
        $newsBar = NewsBar::first();
        if (!$product) {
            return view('error-404');
        }
        $reviews = $product->reviews()->latest()->paginate(10);
        $averageRating = round($product->reviews()->avg('rating'));
        $products = Product::where('id', '!=', $product->id)->paginate(4);

        return view('product', compact('product', 'products', 'reviews', 'averageRating','newsBar'));
    }

    public function showProductAdmin(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|integer',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
            'category' => 'required|in:vitamins,skin care,hair care,herbs,nutrition,weight loss supplements,weight gain supplements',
            'type' => 'required|in:product,offer',
            'quantity' => 'required|integer|min:0'
        ]);
        if($request->hasFile('images')){
            $images= $product->images;
            if ($product->images){
                $product->image= 'null';
                foreach ($images as $image) {
                    unlink(public_path('products_uploads/'.$image->image_path));
                    $image->delete();
                }

            }
            foreach ($request->file('images') as $image) {
                $imageName = time().rand(0,500).'.'.$image->extension();
                 $image->move(public_path('products_uploads'), $imageName);

                Image::create([
                    'product_id' => $product->id,
                    'image_path' => $imageName,
                ]);
            }
        }
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->category = $request->category;
        $product->type = $request->type;
        $product->quantity = $request->quantity;
        $product->save();
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {

        if ($product->image != 'default.png') {
            unlink(public_path('products_uploads/' . $product->image));
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function filterByCategory(Request $request)
    {
        $newsBar = NewsBar::first();

        $category = $request->input('category');

        if ($category == 'all') {
            return redirect()->route('shop');
            //  $products = Product::where('type','product')->paginate(8);
            //  $offers = product::where('type','offer')->paginate(8);
        } else {
            $products = Product::where('type', 'product')
                ->where('category', $category)
                ->paginate(8)
                ->appends(['category' => $category]);

            $offers = Product::where('type', 'offer')
                ->where('category', $category)
                ->paginate(8)
                ->appends(['category' => $category]);;
        }
        return view('shop', compact('products', 'offers','newsBar'));
    }

    public function search(Request $request)
    {
        // Get the search query from the request
        $query = $request->input('name');
    
        // Perform the search query for products
        $products = Product::where('type', 'product')
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->paginate(8)
            ->appends(['query' => $query]);
    
        // Perform the search query for offers
        $offers = Product::where('type', 'offer')
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->paginate(8)
            ->appends(['query' => $query]);
    
        // Return the search results view with both products and offers
        return view('shop', compact('products', 'offers', 'query'));
    }
}
