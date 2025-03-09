<?php

use App\Http\Controllers\NasabahController;
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

Route::get('/', [NasabahController::class, 'index']);
Route::post('/upload', [NasabahController::class, 'store']);
Route::post('/delete/{nasabah}', [NasabahController::class, 'destroy']);
Route::get('dataTablesNasabah', [NasabahController::class, 'dataTables']);
