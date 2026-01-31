<?php

use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Addon\CategoryController as AddonCategoryController;
use App\Http\Controllers\Admin\Product\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard.index');
});


Route::resource("/products", ProductController::class);
Route::resource("/category", CategoryController::class);
Route::resource("/addon-categories", AddonCategoryController::class)->names("admin.addon-categories");
