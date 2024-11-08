<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasPermissionTo('view suppliers', 'api')) {
            return response()->json(Supplier::all());
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function show($id)
    {
        if (auth()->user()->hasPermissionTo('view suppliers', 'api')) {
            return response()->json(Supplier::findOrFail($id));
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('create suppliers', 'api')) {
            $request->validate([
                'name' => 'required|string|max:100', 
                'address' => 'required|string|max:100'
            ]);
            $supplier = Supplier::create($request->only('name', 'address'));
            return response()->json($supplier, 201);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->hasPermissionTo('edit suppliers', 'api')) {
            $request->validate([
                'name' => 'required|string|max:100', 
                'address' => 'required|string|max:100'
            ]);
            $supplier = Supplier::findOrFail($id);
            $supplier->update($request->only('name', 'address'));
            return response()->json($supplier);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function destroy($id)
    {
        if (auth()->user()->hasPermissionTo('delete suppliers', 'api')) {
            $supplier = Supplier::findOrFail($id);
            $supplier->delete();
            return response()->json(['message' => 'Supplier deleted successfully']);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }
}
