<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/register', function () {
    return view('register');
});
Route::get('/thanks', function () {
    return view('thanks');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/', function () {
    return view('index');
});
Route::get('/detail/{restaurant_id}', function () {
    return view('detail');
});
Route::get('done', function () {
    return view('done');
});
Route::get('mypage', function () {
    return view('customer-mypage');
});
