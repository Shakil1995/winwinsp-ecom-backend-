<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PriceTypeController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('category/{category}/change-status', [CategoryController::class, 'toggleStatus'])->name('categories.toggleStatus');

Route::resource('categories',CategoryController::class);

Route::controller(PriceTypeController::class)->prefix('price-types')->as('priceType.')->group(function () {

    Route::get('/', 'index')->name('index');
    Route::post('/', 'store')->name('store');

    Route::get('/create', 'create')->name('create');

    Route::patch('/{priceType}', 'update')->name('update');
    Route::delete('/{priceType}', 'destroy')->name('destroy');

    Route::get('/{priceType}/show', 'show')->name('show');
    Route::get('/{priceType}/edit', 'edit')->name('edit');
    Route::get('/change-status', 'changeStatus')->name('changeStatus');
});
