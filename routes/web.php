<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/cart', function (\Illuminate\Http\Request $request) {
        if ($request->expectsJson()) {
            return app(\App\Http\Controllers\Api\V1\Carts\CartController::class)->show($request);
        }
        return view('front.cart');
    })->name('cart.index');

    Route::get('/checkout', function () {
        return view('front.checkout');
    })->name('checkout.index');

    Route::post('/favorites/toggle/{product}', [\App\Http\Controllers\Web\FavoriteController::class, 'toggle'])->name('favorites.toggle');
});

use App\Http\Controllers\Api\V1\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Api\V1\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Api\V1\Admin\SubcategoryController as AdminSubcategoryController;
use App\Http\Controllers\Api\V1\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Api\V1\Admin\AddOnController as AdminAddOnController;
use App\Http\Controllers\Api\V1\Admin\DeliveryZoneController as AdminDeliveryZoneController;

// Public Customer API Endpoints
Route::get('/products', [\App\Http\Controllers\Api\V1\Products\ProductController::class, 'index']);
Route::get('/products/{id}', [\App\Http\Controllers\Api\V1\Products\ProductController::class, 'show']);
Route::get('/categories', [\App\Http\Controllers\Api\V1\Categories\CategoryController::class, 'index']);
Route::get('/categories/{id}', [\App\Http\Controllers\Api\V1\Categories\CategoryController::class, 'show']);
Route::get('/subcategories', [\App\Http\Controllers\Api\V1\Subcategories\SubcategoryController::class, 'index']);
Route::get('/add-ons', [\App\Http\Controllers\Api\V1\AddOns\AddOnController::class, 'index']);
Route::get('/delivery-zones', [\App\Http\Controllers\Api\V1\DeliveryZones\DeliveryZoneController::class, 'index']);

// Protected Customer API Endpoints
Route::middleware('auth')->group(function () {
    Route::get('/orders', [\App\Http\Controllers\Api\V1\Orders\OrderController::class, 'index']);
    Route::post('/orders', [\App\Http\Controllers\Api\V1\Orders\OrderController::class, 'store']);
    Route::get('/orders/{id}', [\App\Http\Controllers\Api\V1\Orders\OrderController::class, 'show']);

    Route::get('/api/cart', [\App\Http\Controllers\Api\V1\Carts\CartController::class, 'show']);
    Route::post('/cart/items', [\App\Http\Controllers\Api\V1\Carts\CartController::class, 'add']);
    Route::put('/cart/items/{id}', [\App\Http\Controllers\Api\V1\Carts\CartController::class, 'update']);
    Route::delete('/cart/items/{id}', [\App\Http\Controllers\Api\V1\Carts\CartController::class, 'remove']);

    Route::apiResource('addresses', \App\Http\Controllers\Api\V1\Addresses\AddressController::class);
});

// Admin Dashboard & Management Routes
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [\App\Http\Controllers\Web\AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/orders', [AdminOrderController::class, 'index']);
    Route::put('/orders/{id}/status', [AdminOrderController::class, 'update']);

    Route::apiResource('products', AdminProductController::class);
    Route::apiResource('categories', AdminCategoryController::class);
    Route::apiResource('subcategories', AdminSubcategoryController::class);
    Route::apiResource('add-ons', AdminAddOnController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::apiResource('delivery-zones', AdminDeliveryZoneController::class)->only(['index', 'store', 'update', 'destroy']);
});




