<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CollaborationController;
use App\Http\Controllers\CompanyController;
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



Route::get('/collaborations', [CollaborationController::class, 'index']);
Route::get('/collaborations/by-date', [CollaborationController::class, 'byDate']);
Route::get('/collaborations/company/{id}', [CollaborationController::class, 'byCompany']);

// Helper endpoint for the simple frontend
Route::get('/companies', [CompanyController::class, 'index']);


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
