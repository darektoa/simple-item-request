<?php

namespace App\Http\Controllers\Web;
use Illuminate\Support\Facades\Route;

Route::prefix('/stuffs')->group(function() {
    Route::get('/', [StuffController::class, 'index']);
});
