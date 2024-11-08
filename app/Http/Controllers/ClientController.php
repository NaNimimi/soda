<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return response()->json(Client::all());
    }

    public function show($id)
    {
        return response()->json(Client::findOrFail($id));
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('create clients', 'api')) {
            $request->validate([
                'name' => 'required|string|max:100',
                'address' => 'required|string|max:100',
                'phone_number' => 'required|string|max:15',
                'company_name' => 'required|string|max:100'
            ]);

            $client = Client::create($request->only('name', 'address', 'phone_number', 'company_name'));
            return response()->json($client, 201);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->hasPermissionTo('edit clients', 'api')) {
            $request->validate([
                'name' => 'required|string|max:100',
                'address' => 'required|string|max:100',
                'phone_number' => 'required|string|max:15',
                'company_name' => 'required|string|max:100'
            ]);

            $client = Client::findOrFail($id);
            $client->update($request->only('name', 'address', 'phone_number', 'company_name'));
            return response()->json($client);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function destroy($id)
    {
        if (auth()->user()->hasPermissionTo('delete clients', 'api')) {
            $client = Client::findOrFail($id);
            $client->delete();
            return response()->json(['message' => 'Client deleted successfully']);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }
}
