<?php

use App\Http\Controllers\Admin\AddonItemController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Addon\CategoryController as AddonCategoryController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\Product\ProductMediaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard.index');
});


Route::resource("/products", ProductController::class);
Route::get('/products/{product}/assign-addons', [ProductController::class, 'assignAddons'])
    ->name('products.assign-addons');
Route::post('/products/{product}/assign-addons', [ProductController::class, 'storeAssignedAddons'])
    ->name('products.assign-addons.store');
Route::post('/products/{product}/media', [ProductMediaController::class, 'store'])
    ->name('products.media.store');
Route::delete('/products/media/{media}', [ProductMediaController::class, 'destroy'])
    ->name('products.media.destroy');
Route::resource("/category", CategoryController::class);
Route::resource("/addon-categories", AddonCategoryController::class)->names("admin.addon-categories");

Route::resource("/addon-items", AddonItemController::class)->names("admin.addon-items");
