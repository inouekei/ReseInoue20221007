<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\ReviewController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function(){
        Route::get('/mypage', [MyPageController::class, 'index']);
});

Route::middleware(['auth', 'customer'])->group(function(){
        Route::get('/', [RestaurantController::class, 'index']);
        Route::get('/detail/{id}', [RestaurantController::class, 'show']);
        Route::post('/reservation/confirm', [ReservationController::class, 'confirm']);
        Route::post('/reservation/create', [ReservationController::class, 'create']);
        Route::get('/reservation/{id}/edit', [ReservationController::class, 'edit']);
        Route::post('/reservation/{id}/edit', [ReservationController::class, 'update']);
        Route::post('/reservation/{id}/remove', [ReservationController::class, 'remove']);
        Route::get('/reservation/{id}/qr', [ReservationController::class, 'showQr']);
        Route::post('/favorite/create', [FavoriteController::class, 'create']);
        Route::post('/favorite/{id}/remove', [FavoriteController::class, 'remove']);
        Route::get('/review/add', [ReviewController::class, 'add']);
        Route::post('/review/add', [ReviewController::class, 'create']);
});

Route::middleware(['auth', 'manager'])->group(function(){
        Route::get('/restaurant/{id}/edit', [RestaurantController::class, 'edit']);
        Route::post('/restaurant/{id}/update', [RestaurantController::class, 'update']);
        Route::get('/reservation/{id}/email', [ReservationController::class, 'createEmail']);
        Route::post('/reservation/{id}/email', [ReservationController::class, 'sendEmail']);
});
    

require __DIR__.'/auth.php';
