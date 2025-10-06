<?php

use Illuminate\Support\Facades\Route;
use App\Presentation\Controllers\ProductController;
use App\Presentation\Controllers\FetchCitiesFromIbgeController;

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'list']);      
    Route::get('/{id}', [ProductController::class, 'get']); 
    Route::post('/', [ProductController::class, 'create']);
    Route::put('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'delete']);
});

Route::prefix('ibge')->group(function () {
    Route::get('/cities', [FetchCitiesFromIbgeController::class, 'execute']);
});
