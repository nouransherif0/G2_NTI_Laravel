<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Orders\OrderController;
use App\Http\Controllers\Api\V1\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Api\V1\Carts\CartController;
use App\Http\Controllers\Api\V1\Addresses\AddressController;
use App\Http\Controllers\Api\V1\Categories\CategoryController;
use App\Http\Controllers\Api\V1\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Api\V1\Subcategories\SubcategoryController;
use App\Http\Controllers\Api\V1\Admin\SubcategoryController as AdminSubcategoryController;
use App\Http\Controllers\Api\V1\Products\ProductController;
use App\Http\Controllers\Api\V1\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Api\V1\AddOns\AddOnController;
use App\Http\Controllers\Api\V1\Admin\AddOnController as AdminAddOnController;
use App\Http\Controllers\Api\V1\DeliveryZones\DeliveryZoneController;
use App\Http\Controllers\Api\V1\Admin\DeliveryZoneController as AdminDeliveryZoneController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('throttle:api')->group(function () {
    // Public Routes
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{id}', [ProductController::class, 'show']);

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{id}', [CategoryController::class, 'show']);
    Route::get('/subcategories', [SubcategoryController::class, 'index']);

    Route::get('/add-ons', [AddOnController::class, 'index']);
    Route::get('/delivery-zones', [DeliveryZoneController::class, 'index']);

    // Protected User Routes (Require Authentication)
    Route::middleware('auth')->group(function () {
        // Orders
        Route::get('/orders', [OrderController::class, 'index']);
        Route::post('/orders', [OrderController::class, 'store']);
        Route::get('/orders/{id}', [OrderController::class, 'show']);

        // Carts
        Route::get('/cart', [CartController::class, 'show']);
        Route::post('/cart/items', [CartController::class, 'add']);
        Route::put('/cart/items/{id}', [CartController::class, 'update']);
        Route::delete('/cart/items/{id}', [CartController::class, 'remove']);

        // Addresses
        Route::apiResource('addresses', AddressController::class);
    });

    // Admin Routes
    Route::prefix('admin')->middleware(['auth'])->group(function () {
        Route::get('/orders', [AdminOrderController::class, 'index']);
        Route::put('/orders/{id}/status', [AdminOrderController::class, 'update']);

        Route::apiResource('products', AdminProductController::class);
        Route::apiResource('categories', AdminCategoryController::class);
        Route::apiResource('subcategories', AdminSubcategoryController::class);
        Route::apiResource('add-ons', AdminAddOnController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::apiResource('delivery-zones', AdminDeliveryZoneController::class)->only(['index', 'store', 'update', 'destroy']);
    });
});

require __DIR__.'/auth.php';