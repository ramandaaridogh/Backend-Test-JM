<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\UnitController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::name('api.')->group(function () {
    Route::controller(AuthController::class)->group(fn() => [
        Route::post('login', 'login')->name('login'),
        Route::post('register', 'register')->name('register'),
    ]);

    Route::middleware('auth:sanctum')->group(fn() => [
        Route::post('logout', [AuthController::class, 'logout'])->name('logout'),
        Route::apiResource('employees', EmployeeController::class),
        Route::post('employees/table', [EmployeeController::class, 'datatables'])->name('employees.table'),
        Route::apiResource('units', UnitController::class),
        Route::post('units/table', [UnitController::class, 'datatables'])->name('units.table'),
        Route::post('units/select2', [UnitController::class, 'select2'])->name('units.select2'),
    ]);
});

