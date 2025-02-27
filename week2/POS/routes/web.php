<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user/{id}/name/{name}', [UserController::class, 'user']);
Route::get('/', [HomeController::class, 'home']);
Route::get('/penjualan', [PenjualanController::class, 'penjualan']);

Route::prefix('category')->group(function(){
    Route::get('/food-beverage',[ProductsController::class, 'Food_Beverage']);
    Route::get('/beauty-health',[ProductsController::class, 'Beauty_Health']);
    Route::get('/home-care',[ProductsController::class, 'Home_Care']);
    Route::get('/baby-kid',[ProductsController::class, 'Baby_Kid']);
});
