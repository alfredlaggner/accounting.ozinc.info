<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryTotalsController;
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
Route::get('start1',  [CategoryTotalsController::class, 'index1'])->name('start1');
Route::get('start2',  [CategoryTotalsController::class, 'index2'])->name('start2');

