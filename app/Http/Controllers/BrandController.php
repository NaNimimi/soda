<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            return response()->json(auth()->user()->getAllPermissions());
        }

        return response()->json(['message' => 'User is not authenticated'], 401);
    }

    public function show($id)
    {
        return response()->json(Brand::findOrFail($id));
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('create brands', 'api')) {
            $request->validate(['name' => 'required|string|max:100']);
            $brand = Brand::create($request->only('name'));
            return response()->json($brand, 201);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->hasPermissionTo('edit brands', 'api')) {
            $request->validate(['name' => 'required|string|max:100']);
            $brand = Brand::findOrFail($id);
            $brand->update($request->only('name'));
            return response()->json($brand);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function destroy($id)
    {
        if (auth()->user()->hasPermissionTo('delete brands', 'api')) {
            $brand = Brand::findOrFail($id);
            $brand->delete();
            return response()->json(['message' => 'Brand deleted successfully']);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }
}
