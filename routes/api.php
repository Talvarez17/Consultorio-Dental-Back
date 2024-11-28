<?php

use App\Http\Controllers\Api\CitasController;
use App\Http\Controllers\Api\ConsultasController;
use App\Http\Controllers\Api\DoctoresController;
use App\Http\Controllers\Api\PacientesController;
use Illuminate\Support\Facades\Route;


Route::prefix('doctor')->group(function () {
    Route::post('/login', [DoctoresController::class, 'login']);
    Route::get('/getAll', [DoctoresController::class, 'getAll']);
    Route::get('/getOne/{id}', [DoctoresController::class, 'getOne']);
    Route::post('/insert', [DoctoresController::class, 'insert']);
    Route::put('/update/{id}', [DoctoresController::class, 'update']);
    Route::delete('/delete/{id}', [DoctoresController::class, 'delete']);
});

Route::prefix('paciente')->group(function () {
    Route::post('/login', [PacientesController::class, 'login']);
    Route::get('/getAll', [PacientesController::class, 'getAll']);
    Route::get('/getOne/{id}', [PacientesController::class, 'getOne']);
    Route::post('/insert', [PacientesController::class, 'insert']);
    Route::put('/update/{id}', [PacientesController::class, 'update']);
    Route::put('/updatePassword/{id}', [PacientesController::class, 'updatePassword']);
    Route::put('/updateEmail/{id}', [PacientesController::class, 'updateEmail']);
    Route::delete('/delete/{id}', [PacientesController::class, 'delete']);
});

Route::prefix('citas')->group(function () {
    Route::get('/getAllToday', [CitasController::class, 'getAllToday']);
    Route::get('/getAllNext', [CitasController::class, 'getAllNext']);
    Route::get('/getAllCitas', [CitasController::class, 'getAllCitas']);
    Route::get('/getHistorial', [CitasController::class, 'getHistorial']);
    Route::get('/getProximaPaciente', [CitasController::class, 'getProximaPaciente']);
    Route::get('/getOne/{id}', [CitasController::class, 'getOne']);
    Route::post('/horarios', [CitasController::class, 'getHorarios']);
    Route::post('/insert', [CitasController::class, 'insert']);
    Route::put('/update/{id}', [CitasController::class, 'update']);
    Route::delete('/delete/{id}', [CitasController::class, 'delete']);
});

Route::prefix('consulta')->group(function () {
    Route::get('/getAllRecetas', [ConsultasController::class, 'getAllRecetas']);
    Route::get('/getOne/{id}', [ConsultasController::class, 'getOne']);
    Route::post('/insert', [ConsultasController::class, 'insert']);
    Route::put('/update/{id}', [ConsultasController::class, 'update']);
    Route::delete('/delete/{id}', [ConsultasController::class, 'delete']);
});
