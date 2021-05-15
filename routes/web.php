<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryTotalsController;
use App\Http\Controllers\SimplicityController;
use App\Http\Controllers\InvoiceDueController;
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
/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/',  [SimplicityController::class, 'start'])->name('start');
Route::get('import_simplicity', [SimplicityController::class, 'index'])->name('import_simplicity');
Route::post('do_import', [SimplicityController::class ,'import_tags'])->name('do_import');
Route::get('files',  [SimplicityController::class, 'import_simplicity'])->name('files.list');

Route::get('start2',  [CategoryTotalsController::class, 'index2'])->name('start2');
Route::any('totals/{start}/{end}', [CategoryTotalsController::class,'export_category_totals'])->name('totals');

Route::get('due',  [InvoiceDueController::class, 'index'])->name('invoice.due');
