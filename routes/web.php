<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MyPageController;

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
        Route::get('/', [RestaurantController::class, 'index']);
        Route::get('/detail/{id}', [RestaurantController::class, 'show']);
        Route::post('/reservation/confirm', [ReservationController::class, 'confirm']);
        Route::post('/reservation/create', [ReservationController::class, 'create']);
        Route::post('/reservation/{id}/remove', [ReservationController::class, 'remove']);
        Route::post('/favorite/create', [FavoriteController::class, 'create']);
        Route::post('/favorite/{id}/remove', [FavoriteController::class, 'remove']);
        Route::get('/mypage', [MyPageController::class, 'index']);
});


require __DIR__.'/auth.php';
