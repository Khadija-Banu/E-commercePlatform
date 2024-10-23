<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;


class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('category.index',compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        $category = Category::create($request->all());
        return redirect()->route('categories.index');
    }

    public function uploadImage(Request $request)
        {
            $image = $request->file('file');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('upload'), $imageName);
            return response()->json(['url' => $imageName]);
        }


}
