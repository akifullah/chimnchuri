<?php

use App\Http\Controllers\Admin\AddonItemController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Addon\CategoryController as AddonCategoryController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\Category\CategoryMediaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\PaymentGatewayController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\Product\ProductMediaController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SmtpController;
use App\Http\Controllers\Admin\TimeSlotController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Admin\DeliveryZoneController;
use App\Http\Controllers\Admin\OrderDateController;
use App\Http\Controllers\PaymentController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, "index"])->name('admin.dashboard')->middleware('admin');
// ADMIN 
Route::prefix('admin')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [LoginController::class, 'login'])->name('admin.login.post');

    Route::middleware('admin')->group(function () {
        Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');



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
        Route::post('/category/{category}/media', [CategoryMediaController::class, 'store'])
            ->name('category.media.store');
        Route::delete('/category/media/{media}', [CategoryMediaController::class, 'destroy'])
            ->name('category.media.destroy');

        Route::resource("/addon-categories", AddonCategoryController::class)->names("admin.addon-categories");

        Route::resource("/addon-items", AddonItemController::class)->names("admin.addon-items");

        Route::resource("/users", UserController::class)->names("admin.users");

        Route::resource("/smtp", SmtpController::class)->names("admin.smtp");

        Route::resource('/payment-gateways', PaymentGatewayController::class)->names("payment-gateways");

        // ORDER
        Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders');
        Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
        Route::post('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.status');


        // VOUCHERS
        Route::resource('/vouchers', VoucherController::class)->names("vouchers");

        // SETTINGS
        Route::get("/general-settings", [SettingController::class, "index"])->name("admin.general-settings");
        Route::post("/general-settings", [SettingController::class, "update"])->name("admin.general-settings.update");

        // WORKING HOURS
        Route::get("/working-hours", [SettingController::class, "workingHours"])->name("admin.working-hours");
        Route::post("/working-hours", [SettingController::class, "updateWorkingHours"])->name("admin.working-hours.update");

        // OFFERS
        Route::resource("offers", OfferController::class);

        Route::get("/data", [DashboardController::class, "getPerformanceData"])->name("admin.data");
        Route::get("/data-12m", [DashboardController::class, "last12MonthSales"])->name("admin.data.12m");

        // BRANCHES
        Route::resource("branches", BranchController::class)->names("admin.branches");

        // TEAMS
        Route::resource("teams", \App\Http\Controllers\Admin\TeamController::class)->names("admin.teams");

        // DELIVERY ZONES
        Route::resource("delivery-zones", DeliveryZoneController::class)->names("admin.delivery-zones");

        // TIME SLOTS
        Route::get('/time-slots', [TimeSlotController::class, 'index'])->name('admin.time-slots.index');
        Route::get('/time-slots/create', [TimeSlotController::class, 'create'])->name('admin.time-slots.create');
        Route::post('/time-slots/store', [TimeSlotController::class, 'store'])->name('admin.time-slots.store');
        Route::get("/time-slots/{timeSlot}/edit", [TimeSlotController::class, "edit"])->name("admin.time-slots.edit");
        Route::post("/time-slots/{timeSlot}/update", [TimeSlotController::class, "update"])->name("admin.time-slots.update");
        Route::delete("/time-slots/{timeSlot}/delete", [TimeSlotController::class, "destroy"])->name("admin.time-slots.destroy");

        // ORDER DATES
        Route::get('/order-dates', [OrderDateController::class, 'index'])->name('admin.order-dates.index');
        Route::get('/order-dates/create', [OrderDateController::class, 'create'])->name('admin.order-dates.create');
        Route::post('/order-dates/store', [OrderDateController::class, 'store'])->name('admin.order-dates.store');
        Route::get('/order-dates/{orderDate}/edit', [OrderDateController::class, 'edit'])->name('admin.order-dates.edit');
        Route::post('/order-dates/{orderDate}/update', [OrderDateController::class, 'update'])->name('admin.order-dates.update');
        Route::delete('/order-dates/{orderDate}/delete', [OrderDateController::class, 'destroy'])->name('admin.order-dates.destroy');
        Route::post('/order-dates/{orderDate}/toggle-status', [OrderDateController::class, 'toggleStatus'])->name('admin.order-dates.toggle-status');

        // EMAIL PREVIEW
        Route::get('/email-preview/{order?}', function ($orderId = null) {
            $fakeMessage = new class {
                public function embed($path)
                {
                    return asset(str_replace(public_path(), '', $path));
                }
            };

            // If no order ID, show a list of all orders to pick from
            if (!$orderId) {
                $orders = \App\Models\Order::latest()->take(50)->get();
                $html = '<!DOCTYPE html><html><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Email Preview</title>';
                $html .= '<style>
                    body { font-family: "Segoe UI", sans-serif; background: #f0f4f0; margin: 0; padding: 28px; }
                    .container { max-width: 800px; margin: 0 auto; }
                    h1 { color: #396430; font-size: 24px; margin-bottom: 6px; }
                    .subtitle { color: #64748b; font-size: 14px; margin-bottom: 24px; }
                    .order-card { background: #fff; border-radius: 16px; padding: 16px 20px; margin-bottom: 12px; box-shadow: 0 1px 4px rgba(57,100,48,0.06); display: flex; justify-content: space-between; align-items: center; text-decoration: none; }
                    .order-card:hover { box-shadow: 0 4px 16px rgba(57,100,48,0.12); }
                    .order-info { display: flex; flex-direction: column; gap: 2px; }
                    .order-num { font-weight: 700; color: #1e293b; font-size: 15px; }
                    .order-meta { font-size: 12px; color: #64748b; }
                    .order-badge { padding: 4px 12px; border-radius: 20px; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
                    .badge-c { background: #d1fae5; color: #047857; }
                    .badge-d { background: #dbeafe; color: #1d4ed8; }
                    .links { display: flex; gap: 8px; }
                    .links a { padding: 8px 16px; border-radius: 50px; font-size: 12px; font-weight: 600; text-decoration: none; }
                    .link-customer { background: #396430; color: #fff; }
                    .link-admin { background: #f0f7ef; color: #396430; border: 1px solid #d4e5d0; }
                </style></head><body><div class="container">';
                $html .= '<h1>📧 Email Template Preview</h1>';
                $html .= '<p class="subtitle">Click on an order to preview the email templates</p>';

                foreach ($orders as $o) {
                    $typeBadge = $o->order_type == 'collection'
                        ? '<span class="order-badge badge-c">Collection</span>'
                        : '<span class="order-badge badge-d">Delivery</span>';
                    $html .= '<div class="order-card">';
                    $html .= '<div class="order-info">';
                    $html .= '<span class="order-num">#' . $o->order_number . ' — ' . $o->customer_name . '</span>';
                    $html .= '<span class="order-meta">' . $o->created_at->format('D, j M Y h:i A') . ' · £' . number_format($o->grand_total, 2) . ' · ' . $typeBadge . '</span>';
                    $html .= '</div>';
                    $html .= '<div class="links">';
                    $html .= '<a class="link-customer" href="/admin/email-preview/' . $o->id . '?type=customer" target="_blank">Customer Email</a>';
                    $html .= '<a class="link-admin" href="/admin/email-preview/' . $o->id . '?type=admin" target="_blank">Admin Email</a>';
                    $html .= '</div></div>';
                }

                $html .= '</div></body></html>';
                return $html;
            }

            $order = \App\Models\Order::with(['items.addons', 'time_slots'])->findOrFail($orderId);
            $type = request('type', 'customer');
            $view = $type === 'admin' ? 'emails.admin-order-placed' : 'emails.order-placed';

            return view($view, [
                'order' => $order,
                'message' => $fakeMessage,
            ]);
        })->name('admin.email-preview');
    });
});

Route::post("/webhook/stripe", [PaymentController::class, "handleWebhook"])->name("stripe.webhook")->withoutMiddleware([VerifyCsrfToken::class]);
