<?php

use App\Http\Controllers\DocumentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('documents')->group(function () {
        Route::post("new", [DocumentController::class, "new"]);
        Route::patch("{id}", [DocumentController::class, "edit"]);
    });
});
