<?php

namespace App\Http\Controllers;

use App\Models\Barche;
use Illuminate\Http\Request;

class BarcheController extends Controller
{
    public function index()
    {
        return response()->json(Barche::all());
    }

    public function show($id)
    {
        return response()->json(Barche::findOrFail($id));
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('create barches', 'api')) {
            $request->validate(['name' => 'required|string|max:100']);
            $branch = Barche::create($request->only('name'));
            return response()->json($branch, 201);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->hasPermissionTo('edit barches', 'api')) {
            $request->validate(['name' => 'required|string|max:100']);
            $branch = Barche::findOrFail($id);
            $branch->update($request->only('name'));
            return response()->json($branch);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function destroy($id)
    {
        if (auth()->user()->hasPermissionTo('delete barches', 'api')) {
            $branch = Barche::findOrFail($id);
            $branch->delete();
            return response()->json(['message' => 'Branch deleted successfully']);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }
}
