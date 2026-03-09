<?php

use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TimeSlotController;
use App\Http\Controllers\Api\V1\Admin\AddonCategoryController;
use App\Http\Controllers\Api\V1\Admin\AddonGroupController;
use App\Http\Controllers\Api\V1\Admin\AddonItemController;
use App\Http\Controllers\Api\V1\Admin\CategoryController;
use App\Http\Controllers\Api\V1\Admin\ItemController;
use App\Http\Controllers\Api\V1\Admin\ItemSizeController;
use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Auth\PasswordController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Http\Controllers\Api\V1\Auth\TokenController;
use App\Http\Controllers\frontend\CategoryApiController;
use App\Http\Controllers\frontend\ItemApiController;
use App\Http\Controllers\frontend\OrderController;
use App\Http\Controllers\PaymentController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
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
        Route::post("/register", [RegisterController::class, "register"])->name("auth.register")->withoutMiddleware([VerifyCsrfToken::class]);
        Route::post("/login", [RegisterController::class, "auth"])->name("auth.login")->withoutMiddleware([VerifyCsrfToken::class]);
        Route::post('/refresh', [TokenController::class, 'refresh'])->name("auth.refresh")->withoutMiddleware([VerifyCsrfToken::class]);

        // FORGET PASSWORD
        Route::post('/forgot-password', [PasswordController::class, 'forgotPassword'])->name("auth.forgetpassword")->withoutMiddleware([VerifyCsrfToken::class]);
        Route::post('/reset-password', [PasswordController::class, 'resetPassword'])->name("password.reset")->withoutMiddleware([VerifyCsrfToken::class]);

        Route::group(["middleware" => "auth:sanctum"], function () {
            Route::get('profile', [AuthController::class, 'profile'])->name("auth.profile")->withoutMiddleware([VerifyCsrfToken::class]);
            Route::post('profile', [AuthController::class, 'updateProfile'])->name("auth.update.profile")->withoutMiddleware([VerifyCsrfToken::class]);
            Route::post('logout', [AuthController::class, 'logout'])->name("auth.logout")->withoutMiddleware([VerifyCsrfToken::class]);
        });


        Route::get("/categories", [CategoryApiController::class, "index"]);
        Route::get("/categories/{id}", [CategoryApiController::class, "show"]);

        // items
        Route::get("/items", [ItemApiController::class, "index"]);
        Route::get("/items/{id}", [ItemApiController::class, "show"]);

        // orders
        Route::post("/place-order", [OrderController::class, "placeOrder"])->name("orders.place");
        Route::get('/orders/{order}', [OrderController::class, 'getOrder'])->name('getOrder');

        // CHECKOUT
        Route::post("/payment-intent", [PaymentController::class, "createPaymentIntent"])->name("payment-intent")->withoutMiddleware([VerifyCsrfToken::class]);
        Route::post('/process-checkout', [PaymentController::class, 'processCheckout'])->withoutMiddleware([VerifyCsrfToken::class]);


        // SETTINGS API
        Route::get("/settings", [SettingController::class, "settings"]);


        // PAYMENT SETTINGS 
        Route::get("/payment-settings", [SettingController::class, "paymentSettings"]);

        // TIME SLOTS
        Route::get("/time-slots", [TimeSlotController::class, "getAllSlots"]);

        // ORDER DATES
        Route::get("/order-dates", [\App\Http\Controllers\Admin\OrderDateController::class, "getAvailableDates"]);


        Route::group(["middleware" => "auth:sanctum"], function () {
            Route::get("/orders", [OrderController::class, "getOrders"]);
        });

        // OFFER
        Route::get("/offer", [OfferController::class, "getOffer"]);

        // CONTACT
        Route::post("/contact", [\App\Http\Controllers\frontend\ContactApiController::class, "sendContactEmail"]);

        // TEAM
        Route::get("/teams", [\App\Http\Controllers\Admin\TeamController::class, "getTeams"]);

        // DELIVERY ZONES
        Route::get("/delivery-zones", [\App\Http\Controllers\Admin\DeliveryZoneController::class, "getDeliveryZones"]);
        Route::post("/check-delivery", [\App\Http\Controllers\Admin\DeliveryZoneController::class, "checkDelivery"]);
        Route::post("/search-postcodes", [\App\Http\Controllers\Admin\DeliveryZoneController::class, "searchPostcodes"]);
    });
});




Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
