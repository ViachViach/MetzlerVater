<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\PostsController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\UserController;

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

Route::post('token/login', [AuthController::class, 'login']);
Route::post('token/refresh', [AuthController::class, 'refresh']);
Route::get('post', [PostsController::class, 'getAll']);
Route::get('post/{id}', [PostsController::class, 'getById']);

Route::middleware('auth:api')->group(function() {

    Route::post('post', [PostsController::class, 'create']);
    Route::put('post/{id}', [PostsController::class, 'update']);

    Route::post('user', [UserController::class, 'create']);
    Route::put('user/{id}', [UserController::class, 'update']);
    Route::get('user/{id}', [UserController::class, 'getById']);
    Route::get('user', [UserController::class, 'getAll']);
});
