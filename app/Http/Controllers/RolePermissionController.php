<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    public function getAllRoles()
{
    if (auth()->user()->hasPermissionTo('view roles','api')) {
        $roles = Role::all();
        return response()->json($roles);
    }

    return response()->json(['message' => 'Unauthorized'], 403);
}

public function getAllPermissions()
{
    if (auth()->user()->hasPermissionTo('view permissions','api')) {
        $permissions = Permission::all();
        return response()->json($permissions);
    }

    return response()->json(['message' => 'Unauthorized'], 403);
}

    public function assignRole(Request $request, $userId)
    {
        if (auth()->user()->hasPermissionTo('assign roles','api')) {
            $request->validate(['role' => 'required|string|exists:roles,name']);
            
            $user = User::findOrFail($userId);
            $user->assignRole($request->role);

            return response()->json(['message' => 'Role assigned successfully']);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function removeRole(Request $request, $userId)
    {
        if (auth()->user()->hasPermissionTo('remove roles','api')) {
            $request->validate(['role' => 'required|string|exists:roles,name']);
            
            $user = User::findOrFail($userId);
            $user->removeRole($request->role);

            return response()->json(['message' => 'Role removed successfully']);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function createRole(Request $request)
    {
        if (auth()->user()->hasPermissionTo('create roles','api')) {
            $request->validate(['name' => 'required|string|unique:roles,name']);
            
            $role = Role::create(['name' => $request->name]);

            return response()->json($role, 201);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function createPermission(Request $request)
    {
        if (auth()->user()->hasPermissionTo('create permissions','api')) {
            $request->validate(['name' => 'required|string|unique:permissions,name']);
            
            $permission = Permission::create(['name' => $request->name]);

            return response()->json($permission, 201);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function assignPermissionToRole(Request $request)
    {
        if (auth()->user()->hasPermissionTo('assign permissions','api')) {
            $request->validate([
                'role' => 'required|string|exists:roles,name',
                'permission' => 'required|string|exists:permissions,name',
            ]);

            $role = Role::findByName($request->role);
            $role->givePermissionTo($request->permission);

            return response()->json(['message' => 'Permission assigned to role successfully']);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function removePermissionFromRole(Request $request)
    {
        if (auth()->user()->hasPermissionTo('remove permissions','api')) {
            $request->validate([
                'role' => 'required|string|exists:roles,name',
                'permission' => 'required|string|exists:permissions,name',
            ]);

            $role = Role::findByName($request->role);
            $role->revokePermissionTo($request->permission);

            return response()->json(['message' => 'Permission removed from role successfully']);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }
}
