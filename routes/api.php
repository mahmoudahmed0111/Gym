<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\ClubBookingController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\NoteController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


// auth
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('verify-otp', [AuthController::class, 'verifyOtp']);
Route::post('login/google', [AuthController::class, 'loginWithGoogle']);

// home
Route::get('/slider', [HomeController::class, 'slider']);
Route::get('/setting', [HomeController::class, 'setting']);
Route::get('terms_conditions/{type}', [HomeController::class, 'terms_conditions']);


// products
Route::group(['prefix' => 'products'], function () {
    Route::get('/', [HomeController::class, 'products']);
    Route::get('/category', [HomeController::class, 'category']);
    Route::get('/{id}', [HomeController::class, 'product']);
});

// ========================= routes auth driver ========================================
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/top_five_clubs', [ClubBookingController::class, 'top_five_clubs']);
    Route::post('search', [PostController::class, 'searchGeneral']);
    // clubs
    Route::get('category', [ClubBookingController::class, 'category']);
    Route::get('clubs/{categoryId}', [ClubBookingController::class, 'category_club']);
    Route::get('clubs/{clubId}/category/{category}', [ClubBookingController::class, 'category_type']);
    Route::post('clubs/timeslots', [ClubBookingController::class, 'generateTimeSlots']);

    // auth user
    Route::group(['prefix' => 'user'], function () {
        Route::post('/update-profile', [AuthController::class, 'update_profile']);
        Route::get('/get-profile', [AuthController::class, 'get_profile']);
        Route::get('/delete-profile', [AuthController::class, 'delete_profile']);
        Route::post('/change-password', [AuthController::class, 'change_Password']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });

    // notes
    Route::get('bookings', [ClubBookingController::class, 'user_booking']);
    Route::post('clubs/{clubId}/book', [ClubBookingController::class, 'bookTimeSlot']);
    Route::post('callback/booking', [ClubBookingController::class, 'handlePayment']);
    Route::post('validateQrCode', [ClubBookingController::class, 'validateQrCode']);
    Route::post('bookings/refund/{id}', [ClubBookingController::class, 'refund']);


    Route::post('/subscribe', [HomeController::class, 'subscribe']);

    // address
    Route::post('address', [HomeController::class, 'add_address']);
    Route::get('address', [HomeController::class, 'get_addresses']);
    Route::post('orders', [HomeController::class, 'store_order']);
    Route::post('handlePayment', [HomeController::class, 'handlePayment']);

    // carts
    Route::post('/carts', [CartController::class, 'store']);
    Route::post('/carts/update_quantity', [CartController::class, 'update_cart_quantity']);
    Route::get('/carts', [CartController::class, 'cart']);
    Route::delete('/carts/{id}', [CartController::class, 'delete_cart']);
    Route::delete('/carts', [CartController::class, 'delete_all_carts']);

    // reviews
    Route::post('/reviews', [ReviewController::class, 'store']);
    Route::put('/reviews/{review}', [ReviewController::class, 'update']);
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy']);

    // posts
    Route::apiResource('posts', PostController::class);
    Route::get('posts/reels/get', [PostController::class, 'reels']);
    Route::get('posts/{post}/like', [PostController::class, 'like']);
    Route::get('posts/tag/{tag}', [PostController::class, 'searchByHashtag']);

    // notes
    Route::apiResource('notes', NoteController::class);
});
