<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\ProductVariantController;

Route::middleware('auth:api')->group(function () {
    Route::post('brands', [BrandController::class, 'store']);
    Route::put('brands/{id}', [BrandController::class, 'update']);
    Route::delete('brands/{id}', [BrandController::class, 'destroy']);
    Route::get('brands', [BrandController::class, 'index']);
Route::get('brands/{id}', [BrandController::class, 'show']);

    Route::post('categories', [CategoryController::class, 'store']);
    Route::put('categories/{id}', [CategoryController::class, 'update']);
    Route::delete('categories/{id}', [CategoryController::class, 'destroy']);

    Route::post('sizes', [SizeController::class, 'store']);
    Route::put('sizes/{id}', [SizeController::class, 'update']);
    Route::delete('sizes/{id}', [SizeController::class, 'destroy']);

    Route::post('products', [ProductController::class, 'store']);
    Route::put('products/{id}', [ProductController::class, 'update']);
    Route::delete('products/{id}', [ProductController::class, 'destroy']);

    Route::post('barches', [BranchController::class, 'store']);
    Route::put('barches/{id}', [BranchController::class, 'update']);
    Route::delete('barches/{id}', [BranchController::class, 'destroy']);

    Route::post('suppliers', [SupplierController::class, 'store']);
    Route::put('suppliers/{id}', [SupplierController::class, 'update']);
    Route::delete('suppliers/{id}', [SupplierController::class, 'destroy']);

    Route::post('clients', [ClientController::class, 'store']);
    Route::put('clients/{id}', [ClientController::class, 'update']);
    Route::delete('clients/{id}', [ClientController::class, 'destroy']);

    Route::post('product-variants', [ProductVariantController::class, 'store']);
    Route::put('product-variants/{id}', [ProductVariantController::class, 'update']);
    Route::delete('product-variants/{id}', [ProductVariantController::class, 'destroy']);

    Route::post('/role/assign/{userId}', [RolePermissionController::class, 'assignRole']);
    Route::post('/role/remove/{userId}', [RolePermissionController::class, 'removeRole']);
    Route::post('/role/create', [RolePermissionController::class, 'createRole']);
    Route::post('/permission/create', [RolePermissionController::class, 'createPermission']);
    Route::post('/role/assign-permission', [RolePermissionController::class, 'assignPermissionToRole']);
    Route::post('/role/remove-permission', [RolePermissionController::class, 'removePermissionFromRole']);
    Route::get('/roles', [RolePermissionController::class, 'getAllRoles']);
    Route::get('/permissions', [RolePermissionController::class, 'getAllPermissions']);

});




Route::get('categories', [CategoryController::class, 'index']);
Route::get('categories/{id}', [CategoryController::class, 'show']);

Route::get('sizes', [SizeController::class, 'index']);
Route::get('sizes/{id}', [SizeController::class, 'show']);

Route::get('products', [ProductController::class, 'index']);
Route::get('products/{id}', [ProductController::class, 'show']);

Route::get('branches', [BranchController::class, 'index']);
Route::get('branches/{id}', [BranchController::class, 'show']);

Route::get('suppliers', [SupplierController::class, 'index']);
Route::get('suppliers/{id}', [SupplierController::class, 'show']);

Route::get('clients', [ClientController::class, 'index']);
Route::get('clients/{id}', [ClientController::class, 'show']);

Route::get('product-variants', [ProductVariantController::class, 'index']);
Route::get('product-variants/{id}', [ProductVariantController::class, 'show']);

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
