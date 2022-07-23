<?php

namespace App\Http\Controllers\Web;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/stuffs');

Route::prefix('/stuffs')->name('stuffs.')->group(function() {
    Route::get('/', [StuffController::class, 'index'])->name('index');
    Route::get('/requests', [StuffRequestController::class, 'index'])->name('requests.index');
});
