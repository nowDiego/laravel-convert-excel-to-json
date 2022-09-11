<?php

use App\Http\Controllers\ExcelController;
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

Route::get('/',[ExcelController::class,'index']);

Route::get('/excel',[ExcelController::class,'index'])->name('excel.import');
    
Route::post('/excel',[ExcelController::class,'store'])->name('excel.import');

Route::get('/download/{filename}',[ExcelController::class,'download'])->name('excel.download');

