<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::with(['category_id', 'brand_id'])->get());
    }

    public function show($id)
    {
        return response()->json(Product::with(['category_id', 'brand_id'])->findOrFail($id));
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('create products', 'api')) {
            $request->validate([
                'name' => 'required|string|max:100',
                'category_id' => 'required|exists:categories,id',
                'brand_id' => 'required|exists:brands,id'
            ]);

            $product = Product::create($request->only('name', 'category_id', 'brand_id'));
            return response()->json($product, 201);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->hasPermissionTo('edit products', 'api')) {
            $request->validate([
                'name' => 'required|string|max:100',
                'category_id' => 'required|exists:categories,id',
                'brand_id' => 'required|exists:brands,id'
            ]);

            $product = Product::findOrFail($id);
            $product->update($request->only('name', 'category_id', 'brand_id'));
            return response()->json($product);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function destroy($id)
    {
        if (auth()->user()->hasPermissionTo('delete products', 'api')) {
            $product = Product::findOrFail($id);
            $product->delete();
            return response()->json(['message' => 'Product deleted successfully']);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }
}
