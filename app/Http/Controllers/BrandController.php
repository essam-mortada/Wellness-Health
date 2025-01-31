<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    // Store a new brand
    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $brand= new Brand();
        if ($request->hasFile('logo')) {
            $imageName = time().rand(0,500).'.'.$request->logo->extension();
            $request->logo->move(public_path('brands'), $imageName);
            $brand->logo = $imageName;
        }
        $brand->save();


        return redirect()->route('brands.index')->with('success', 'Brand added successfully!');
    }

    // Show edit form
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    // Update brand
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('logo')) {
        unlink(public_path('brands/'.$brand->logo));
        $imageName = time().'.'.$request->logo->extension();
        $request->logo->move(public_path('brands'), $imageName);
        $brand->logo = $imageName;

        }
        $brand->save();

        return redirect()->route('brands.index')->with('success', 'Brand updated successfully!');
    }

    // Delete brand
    public function destroy(Brand $brand)
    {
        //unlink(public_path('brands/'.$brand->logo));
        $brand->delete();

        return redirect()->route('brands.index')->with('success', 'Brand deleted successfully!');
    }
}
