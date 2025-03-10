<?php

use \App\Http\Controllers\GameController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);
Route::post('/logout', [AuthController::class,'logout']);

Route::post('/games', [GameController::class, 'create'])->middleware('auth:sanctum');
Route::get('/games', [GameController::class, 'read'])->middleware('auth:sanctum');
Route::put('/games/{id}', [GameController::class, 'update'])->middleware(['auth:sanctum','game.editable']);
Route::delete('/games/{id}', [GameController::class, 'delete'])->middleware(['auth:sanctum', 'game.editable']);
