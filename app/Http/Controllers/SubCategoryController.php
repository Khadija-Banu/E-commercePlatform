<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::with('category')->get();
        return view('subcategories.index', compact('subcategories'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('subcategories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'category_id' => 'required',
            'name' => 'required|string|max:255',
        ]);

        $subcategory = SubCategory::create($request->all());

        return redirect()->route('subcategories.index');
    }

    public function uploadImage(Request $request)
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('upload'), $imageName);
        return response()->json(['url' => $imageName]);
    }
}
