<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\NextOfKinController;
use App\Http\Controllers\RefereesController;
use App\Http\Controllers\LeavesController;


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



Route::post('/contact/{id}/create',[ContactController::class, 'store']);
Route::get('/contacts', [ContactController::class, 'index']);
Route::put('/contact/{id}', [ContactController::class, 'update']);
Route::get('/employee/{id}/contacts', [ContactController::class, 'getContacts']);



Route::post('/contract/{id}/create',[ContractController::class, 'store']);
Route::get('/contracts', [ContractController::class, 'index']);
Route::put('/contract/{id}', [ContractController::class, 'update']);
Route::get('/employee/{id}/contracts', [ContractController::class, 'getContracts']);




Route::post('/kin/{id}/create',[NextOfKinController::class, 'store']);
Route::get('/kins', [NextOfKinController::class, 'index']);
Route::put('/kin/{id}', [NextOfKinController::class, 'update']);
Route::get('/employee/{id}/kins', [NextOfKinController::class, 'getKins']);



Route::post('/referee/{id}/create',[RefereesController::class, 'store']);
Route::get('/referees', [RefereesController::class, 'index']);
Route::put('/referee/{id}', [RefereesController::class, 'update']);
Route::get('/employee/{id}/referees', [RefereesController::class, 'getReferees']);



Route::post('/leave/{id}/create',[LeavesController::class, 'store']);
Route::get('/leaves', [LeavesController::class, 'index']);
Route::put('/leave/{id}', [LeavesController::class, 'update']);
Route::get('/employee/{id}/leaves', [LeavesController::class, 'getLeaves']);