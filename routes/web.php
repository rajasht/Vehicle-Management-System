<?php

use App\Http\Controllers\AddCarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\RegistrationController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register',[RegistrationController::class,'index']);
Route::post('/register',[RegistrationController::class,'register']);

Route::get('login',[CarController::class,'customerDashboard']);

Route::get('logout', function () {
    if (session()->has('email')) {
        session()->pull('email');
    }
    return redirect('login');
});

Route::view('visitor', 'profile/visitor');
Route::view('profile/customer', 'profile/customer');
Route::view('profile/dealer', 'profile/dealer');
Route::view('profile/admin', 'profile/admin');

Route::post('user_login', [UserController::class, 'userLogin']);

Route::get('dashboard',[CarController::class,'carsDashboard']);
Route::post('getcar',[CarController::class,'carsDashboard']);


Route::view('mycart','profile.mycart');
Route::get('dealer/{id}',[CarController::class,'show']);
Route::get('/addcar',[AddCarController::class,'index']);
Route::post('/addcar',[AddCarController::class,'carDetailsToAdmin']);


Route::get('dealer-car/{id}',[CarController::class,'show']);