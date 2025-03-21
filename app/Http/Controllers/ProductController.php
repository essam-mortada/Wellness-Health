<?php

namespace App\Http\Controllers;

use App\Models\Brand;
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
        $query = Product::query();

        if ($request->filled('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('description', 'LIKE', '%' . $request->search . '%');
        }

        $products = $query->paginate(5);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::all();
        return view('admin.products.create',compact('brands'));
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
            'images.*'=>'image|mimes:jpeg,png,jpg,svg|max:2048',
            'category'=>'required|in:vitamins,skin care,hair care,herbs,nutrition,weight loss supplements,weight gain supplements',
            'type'=>'required|in:product,offer',
            'quantity'=>'required|integer|min:0',
            'video' => 'nullable|file|mimes:mp4,mov,avi|max:20480',
            'brand_id'=>'nullable|exists:brands,id'
            ]);


            $product = new product();
            $product->name = $request->name;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->quantity = $request->quantity;
            $product->category= $request->category;
            $product->type= $request->type;
            $product->brand_id= $request->brand_id;
             // Store multiple images
             if ($request->hasFile('video')) {
                $video = $request->file('video');
                $videoName = time().'_'.$video->getClientOriginalName();
                $video->move(public_path('products_videos'), $videoName);
                $product->video = $videoName;
            }
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
            return redirect()->route('products.index')->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($product)
    {
        $product = Product::with('images')->find($product);

        if (!$product) {
            return response()->view('error-404', [], 404);
        }

        $newsBar = NewsBar::first();
        $reviews = $product->reviews()->latest()->paginate(10);
        $averageRating = round($product->reviews()->avg('rating'));
        $products = Product::where('id', '!=', $product->id)->paginate(4);

        return view('product', compact('product', 'products', 'reviews', 'averageRating', 'newsBar'));
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
        $brands = Brand::all();
        return view('admin.products.edit',compact('product','brands'));

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
            'images.*'=>'image|mimes:jpeg,png,jpg,svg|max:2048',
            'category'=>'required|in:vitamins,skin care,hair care,herbs,nutrition,weight loss supplements,weight gain supplements',
            'type'=>'required|in:product,offer',
            'quantity'=>'required|integer|min:0',
            'video' => 'nullable|file|mimes:mp4,mov,avi|max:20480',
            'brand_id'=>'nullable|exists:brands,id'
        ]);
        if ($request->hasFile('video')) {
            // Delete old video
            if ($product->video) {
                unlink(public_path('products_videos/'.$product->video));
            }

            $video = $request->file('video');
            $videoName = time().'_'.$video->getClientOriginalName();
            $video->move(public_path('products_videos'), $videoName);
            $product->video = $videoName;
        }
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
        $product->category= $request->category;
        $product->type= $request->type;
        $product->quantity = $request->quantity;
        $product->brand_id = $request->brand_id;
        $product->save();
        return redirect()->route('products.index')->with('success','Product updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product)
    {
        if ($product->video) {
            unlink(public_path('products_videos/'.$product->video));
        }
        $images= $product->images;
        if ($product->image != 'default.png') {
            foreach ($images as $image) {
                unlink(public_path('products_uploads/'.$image->image_path));
                $image->delete();
            }

        }
        $product->delete();
        return redirect()->route('products.index')->with('success','Product deleted successfully.');
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
        $newsBar = NewsBar::first();

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
        return view('shop', compact('products', 'offers', 'query','newsBar'));
    }

        public function showByBrand(Brand $brand)
    {
        $newsBar = NewsBar::first();
        $products = $brand->products()->where('type','product')->paginate(8);
        $offers = $brand->products()->where('type','offer')->paginate(8);
        return view('shop', compact('brand', 'products','newsBar','offers'));
    }
}
