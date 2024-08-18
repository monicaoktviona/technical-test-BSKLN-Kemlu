<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/datatables', [App\Http\Controllers\Web\NegaraController::class, 'datatable'])->name('datatables.data');

Route::get('/geomap', [App\Http\Controllers\Web\NegaraController::class, 'geomap']);