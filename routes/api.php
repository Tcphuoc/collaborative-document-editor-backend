<?php

use App\Http\Controllers\DocumentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('documents')->group(function () {
        Route::get("/", [DocumentController::class, "index"]);
        Route::post("create", [DocumentController::class, "create"]);
        Route::patch("{id}", [DocumentController::class, "update"]);
    });
});
