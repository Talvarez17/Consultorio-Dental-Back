<?php

use App\Http\Controllers\Api\DoctoresController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('doctor')->group(function () {
    Route::post('/login', [DoctoresController::class, 'login']);
    Route::get('/getAll', [DoctoresController::class, 'getAll']);
    Route::get('/getOne/{id}', [DoctoresController::class, 'getOne']);
    Route::post('/insert', [DoctoresController::class, 'insert']);
    Route::put('/update/{id}', [DoctoresController::class, 'update']);
    Route::delete('/delete/{id}', [DoctoresController::class, 'delete']);
});
