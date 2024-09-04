<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Auth;


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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});


Route::get('/products', [App\Http\Controllers\ProjectController::class, 'index'])->name('products.index');
Route::get('/products/create', [App\Http\Controllers\ProjectController::class, 'create'])->name('products.create');
Route::post('/products/store', [App\Http\Controllers\ProjectController::class, 'store'])->name('products.store');
Route::get('/products/{product}/edit', [App\Http\Controllers\ProjectController::class, 'edit'])->name('products.edit');
Route::put('/products/{product}' , [App\Http\Controllers\ProjectController::class, 'update'])->name('products.update');
Route::get('/products/{product}', [App\Http\Controllers\ProjectController::class, 'show'])->name('products.show');
Route::delete('/products/{product}', [ProjectController::class, 'destroy'])->name('products.destroy');
Route::get('/products/register', [App\Http\Controllers\ProjectController::class, 'register'])->name('products.register');
Route::post('/products/register', [App\Http\Controllers\ProjectController::class, 'register'])->name('products.register');


