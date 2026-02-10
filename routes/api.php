<?php

use App\Http\Controllers\Api\V1\Admin\AddonCategoryController;
use App\Http\Controllers\Api\V1\Admin\AddonGroupController;
use App\Http\Controllers\Api\V1\Admin\AddonItemController;
use App\Http\Controllers\Api\V1\Admin\CategoryController;
use App\Http\Controllers\Api\V1\Admin\ItemController;
use App\Http\Controllers\Api\V1\Admin\ItemSizeController;
use App\Http\Controllers\Api\v1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Auth\PasswordController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Http\Controllers\Api\V1\Auth\TokenController;
use App\Http\Controllers\frontend\CategoryApiController;
use App\Http\Controllers\frontend\ItemApiController;
use App\Http\Controllers\frontend\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix("v1")->group(function () {

    Route::group(["prefix" => "auth"], function () {

        // PUBLIC ROUTES
        Route::post('/refresh', [TokenController::class, 'refresh'])->name("auth.refresh");
        // Route::post("/login", [AuthController::class, "login"])->name("auth.login");
        Route::post("/register", [RegisterController::class, "register"])->name("auth.register");

        // FORGET PASSWORD
        Route::post('/forgot-password', [PasswordController::class, 'forgotPassword'])->name("auth.forgetpassword");
        Route::post('/reset-password', [PasswordController::class, 'resetPassword'])->name("password.reset");

        // PROTECTED ROUTES
        Route::group(["middleware" => "auth:sanctum"], function () {
            Route::get('profile', [AuthController::class, 'profile'])->name("auth.profile");
            Route::post('logout', [AuthController::class, 'logout'])->name("auth.logout");
        });
    });


    // ADMIN ROUTES
    // Route::apiResource("/categories", CategoryController::class);
    Route::apiResource("/items", ItemController::class);
    // Route::apiResource("/items/sizes", ItemSizeController::class);
    // Route::apiResource("/addon-categories", AddonCategoryController::class);
    // Route::apiResource("/addon-items", AddonItemController::class);

    // Route::get('/items/{item}/addon-groups', [AddonGroupController::class, 'index']);
    // Route::post('/items/addon-groups', [AddonGroupController::class, 'store']);
    // Route::put('/items/addon-groups/{id}', [AddonGroupController::class, 'update']);



    // FRONTEND
    Route::prefix("frontend")->group(function () {
        Route::post("/register", [RegisterController::class, "register"])->name("auth.register");
        Route::post("/login", [AuthController::class, "login"])->name("auth.login");
        Route::post('/refresh', [TokenController::class, 'refresh'])->name("auth.refresh");

        Route::group(["middleware" => "auth:sanctum"], function () {
            Route::get('profile', [AuthController::class, 'profile'])->name("auth.profile");
            Route::post('logout', [AuthController::class, 'logout'])->name("auth.logout");
        });


        Route::get("/categories", [CategoryApiController::class, "index"]);
        Route::get("/categories/{id}", [CategoryApiController::class, "show"]);

        // items
        Route::get("/items", [ItemApiController::class, "index"]);
        Route::get("/items/{id}", [ItemApiController::class, "show"]);

        // orders
        Route::post("/place-order", [OrderController::class, "placeOrder"])->name("orders.place");
    });
});




Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
