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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/products', [App\Http\Controllers\ProjectController::class, 'index'])->name('products.index');

Route::get('/products/create',[App\Http\Controllers\ProjectController::class, 'create'])->name('products.create');
Route::post('/products/store',[App\Http\Controllers\ProjectController::class, 'store'])->name('products.store');
