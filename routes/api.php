<?php

use App\Http\Controllers\Api\V1\BoardController;
use App\Http\Controllers\Api\V1\CardController;
use App\Http\Controllers\Api\V1\ColumnController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('v1')->group(function () {
        Route::prefix('user')->group(function () {
            Route::prefix('{user}')->group(function () {
                Route::apiResource('boards', BoardController::class)->only('index');
            });
        });
        Route::apiResource('boards', BoardController::class)->except('index');
        Route::apiResource('columns', ColumnController::class)->except('index', 'show');
        Route::apiResource('cards', CardController::class)->except('index');
    });
});