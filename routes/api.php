<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Resources\PermissionsResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/login', [AuthController::class, 'login']);

Route::get('/user', function (Request $request) {
    $user = $request->user()->with('locations')->first();

    return response()->json([
        'data' => $user
    ]);
})->middleware('auth:sanctum');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('products', ProductController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('suppliers', SupplierController::class);
    Route::apiResource('locations', LocationController::class);
    Route::apiResource("roles", RoleController::class);
    Route::apiResource("resources", ResourceController::class);
    Route::apiResource("users", UserController::class);
    Route::apiResource("packages", PackageController::class);
}, function () {
    return response()->json([
        'message' => 'Unauthorized'
    ], 401);
});
