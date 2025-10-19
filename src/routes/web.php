<?php

use App\Http\Controllers\ScanController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/scans');

Route::prefix('/scans')
    ->name('scans.')
    ->group(function () {
        Route::get('/', [ScanController::class, 'index'])->name('index');
        Route::post('/', [ScanController::class, 'store'])->name('store');

        Route::get('/in-progress', [ScanController::class, 'scanInProgress'])->name('in-progress');
    });
