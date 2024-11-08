<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasPermissionTo('view sizes', 'api')) {
            return response()->json(Size::all());
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function show($id)
    {
        if (auth()->user()->hasPermissionTo('view sizes', 'api')) {
            return response()->json(Size::findOrFail($id));
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('create sizes', 'api')) {
            $request->validate(['name' => 'required|string|max:100']);
            $size = Size::create($request->only('name'));
            return response()->json($size, 201);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->hasPermissionTo('edit sizes', 'api')) {
            $request->validate(['name' => 'required|string|max:100']);
            $size = Size::findOrFail($id);
            $size->update($request->only('name'));
            return response()->json($size);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function destroy($id)
    {
        if (auth()->user()->hasPermissionTo('delete sizes', 'api')) {
            $size = Size::findOrFail($id);
            $size->delete();
            return response()->json(['message' => 'Size deleted successfully']);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }
}
