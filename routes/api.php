<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\BusinessTypeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\InventoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/register', [RegisterController::class, 'store'])->name('register');

// business types
Route::get('/business-types/get', [BusinessTypeController::class, 'getBusinessTypes']);



Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    // Categories
    Route::post('/categories/{business_id}/store', [CategoryController::class, 'store']);
    Route::get('/categories/{business_id}/get', [CategoryController::class, 'getCategories']);
    Route::patch('/categories/{category_id}/update', [CategoryController::class,'update']);
    Route::delete('/categories/{category_id}/destroy', [CategoryController::class,'destroy']);

    // Product
    Route::post('/products/{business_id}/store', [ProductController::class, 'store']);
    Route::get('/products/{business_id}/get',[ProductController::class,'getProducts']);
    Route::patch('/products/{product_id}/update', [ProductController::class,'update']);
    Route::patch('/products/{product_id}/status', [ProductController::class,'status']);
    Route::delete('/products/{product_id}/destroy', [ProductController::class,'destroy']);

    // Business
    Route::get('/businesses/get', [BusinessController::class, 'getBusinesses']);
    Route::get('/business/{business_id}/get', [BusinessController::class, 'getBusiness']);

    // Inventory
    Route::post('/inventories/store', [InventoryController::class,'store']);
    Route::get('/inventories/{business_id}/get', [InventoryController::class,'getInventories']);
});
