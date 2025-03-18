<?php

use App\Exports\NasabahExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\NasabahController;

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
Route::get('/render-filter', [NasabahController::class, 'render_filter']);
Route::post('/upload', [NasabahController::class, 'store']);
Route::get('/edit/{nasabah}', [NasabahController::class, 'edit']);
Route::post('/update/{nasabah}', [NasabahController::class, 'update']);
Route::post('/delete/{nasabah}', [NasabahController::class, 'destroy']);
Route::get('dataTablesNasabah', [NasabahController::class, 'dataTables']);

Route::post('/cetak-lkn', [PDFController::class, 'cetak_lkn']);

Route::get('/download-template', function () {
    return Excel::download(new NasabahExport, 'template_lkn.xlsx');
});
