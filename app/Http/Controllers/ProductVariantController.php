<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    public function index()
    {
        return response()->json(ProductVariant::with(['product_id', 'size_id'])->get());
    }

    public function show($id)
    {
        return response()->json(ProductVariant::with(['product_id', 'size_id'])->findOrFail($id));
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('create product variants', 'api')) {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'size_id' => 'nullable|exists:sizes,id',
                'price' => 'required|numeric',
                'sell_price' => 'required|numeric'
            ]);

            $variant = ProductVariant::create($request->only('product_id', 'size_id', 'price', 'sell_price'));
            return response()->json($variant, 201);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->hasPermissionTo('edit product variants', 'api')) {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'size_id' => 'nullable|exists:sizes,id',
                'price' => 'required|numeric',
                'sell_price' => 'required|numeric'
            ]);

            $variant = ProductVariant::findOrFail($id);
            $variant->update($request->only('product_id', 'size_id', 'price', 'sell_price'));
            return response()->json($variant);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function destroy($id)
    {
        if (auth()->user()->hasPermissionTo('delete product variants', 'api')) {
            $variant = ProductVariant::findOrFail($id);
            $variant->delete();
            return response()->json(['message' => 'Product variant deleted successfully']);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }
}
