<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::all());
    }

    public function show($id)
    {
        return response()->json(Category::findOrFail($id));
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('create categories', 'api')) {
            $request->validate(['name' => 'required|string|max:100']);
            $category = Category::create($request->only('name'));
            return response()->json($category, 201);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->hasPermissionTo('edit categories', 'api')) {
            $request->validate(['name' => 'required|string|max:100']);
            $category = Category::findOrFail($id);
            $category->update($request->only('name'));
            return response()->json($category);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function destroy($id)
    {
        if (auth()->user()->hasPermissionTo('delete categories', 'api')) {
            $category = Category::findOrFail($id);
            $category->delete();
            return response()->json(['message' => 'Category deleted successfully']);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }
}
