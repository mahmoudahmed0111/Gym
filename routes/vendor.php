<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Dashboard\ClubController;
use App\Http\Controllers\VendorDashboard\AuthController;
use App\Http\Controllers\VendorDashboard\HomeController;
use App\Http\Controllers\VendorDashboard\UserController;
use App\Http\Controllers\VendorDashboard\AdminController;
use App\Http\Controllers\VendorDashboard\OfferController;
use App\Http\Controllers\VendorDashboard\OrderController;
use App\Http\Controllers\VendorDashboard\ReportController;
use App\Http\Controllers\VendorDashboard\VendorController;
use App\Http\Controllers\VendorDashboard\WalletController;
use App\Http\Controllers\VendorDashboard\PaymentController;
use App\Http\Controllers\VendorDashboard\ProductController;
use App\Http\Controllers\VendorDashboard\ReviewsController;
use App\Http\Controllers\VendorDashboard\SettingController;
use App\Http\Controllers\VendorDashboard\SupportController;
use App\Http\Controllers\VendorDashboard\CategoryProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group(['prefix' => 'vendor', 'as' => 'vendor.','middleware'=>['localization',]], function () {
///////////////////////////  dashboard vendor   ///////////////////////////////////////////////////////////
    Route::get('/', function () {
        return redirect()->to('vendor/dashboard');
    });
    Route::get('login', [AuthController::class, 'create'])->name("login");
    Route::post('login', [AuthController::class, 'login'])->name("login");
    Route::get('logout', [AuthController::class, 'logout'])->name("logout");
    Route::middleware([ "vendor"])->group(function () {

        Route::get('/dashboard',[HomeController::class,'dashboard'])->name("dashboard.index");


        Route::get("vendor/users", [UserController::class,'index'])->name('vendor.user');

        // Route::get("vendor/admins", AdminController::class)->name('vendor.admin');

        // Route::get("vendor/vendors", VendorController::class)->name('vendor.vendor');




            Route::resource("settings", SettingController::class);

            Route::resource("category_products", CategoryProductController::class);
            Route::post('/category_products/deleteSelected', [CategoryProductController::class,'deleteSelected'])->name('category_products.deleteSelected');

            Route::resource("products", ProductController::class);
            Route::post('dropzone',[ProductController::class, 'dropzone'])->name('dropzone.files');
            Route::post('/products/deleteSelected', [ProductController::class,'deleteSelected'])->name('products.deleteSelected');
            Route::post('toggle-activation/products', [ProductController::class, 'toggleActivation'])->name('products.toggleActivation');


            Route::get('/offers/products', [OfferController::class,'offer_on_product'])->name('offers.products');
            Route::resource("offers", OfferController::class);
            Route::post('/offers/deleteSelected', [OfferController::class,'deleteSelected'])->name('offers.deleteSelected');
            Route::post('/offers/products', [OfferController::class,'store_offer_on_product'])->name('offers.products.store');
            Route::post('toggle-activation/offers', [OfferController::class, 'toggleActivation'])->name('products.toggleActivation');

            Route::get('/orders', [OrderController::class,'index'])->name('orders.index');
            Route::get('/orders/{id}', [OrderController::class,'show'])->name('orders.show');
            Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
            Route::put('/items/{id}/status', [OrderController::class, 'updateItemStatus'])->name('orders.items.status');

            Route::resource("payment_logs", PaymentController::class);
            Route::get('/payment/pay', [PaymentController::class,'AdminToVendorPayment'])->name('payment.pay');

            Route::resource("reviews", ReviewsController::class);
            Route::post('/reviews/deleteSelected', [ReviewsController::class,'deleteSelected'])->name('reviews.deleteSelected');

            Route::get('/reports/order', [ReportController::class,'order'])->name('reports.order');
            Route::get('/reports/bestSales', [ReportController::class,'bestSales'])->name('reports.bestSales');

            Route::resource("supports", SupportController::class);

            Route::resource("wallets", WalletController::class);

    });

});
