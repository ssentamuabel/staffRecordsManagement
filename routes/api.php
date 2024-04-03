<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('/auth/register', [UserController::class, 'createUser']);


Route::post('/employee/create', [EmployeeController::class, 'createEmployee']);
Route::put('/employee/update/{id}', [EmployeeController::class, 'updateEmployee']);
Route::get('/employees', [EmployeeController::class, 'getAll']);
Route::get('/employee/{id}', [EmployeeController::class, 'show']);
Route::delete('/employee/{id}', [EmployeeController::class, 'destroy']);