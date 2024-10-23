<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('product.index',compact('products'));
    }


    public function create()
    {
        $categories = Category::all();
        $subcategories = SubCategory::all(); // Alternatively, you can fetch by category dynamically
        return view('product.create', compact('categories', 'subcategories'));
    }

    public function store(Request $request)
    {

        // Validation
        $request->validate([
            'subcategory_id' => 'required',
            'product_name' => 'required|string|max:255',
            'description' => 'required',
            'old_price' => 'nullable|numeric',
            'new_price' => 'required|numeric',
        ]);


        $product = Product::create($request->all());

        return redirect()->route('products.index')->with('success', 'Product added successfully.');
    }

    public function uploadImage(Request $request)
        {
            $image = $request->file('file');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('upload'), $imageName);
            return response()->json(['url' => $imageName]);
        }
}
