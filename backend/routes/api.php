<?php

use App\Http\Controllers\TasksController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', [TasksController::class, 'index']);
Route::post('/task', [TasksController::class, 'store']);
Route::put('/task/{task}', [TasksController::class, 'update']);
Route::delete('/task/{id}', [TasksController::class, 'destroy']);
