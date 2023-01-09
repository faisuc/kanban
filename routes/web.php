<?php

use App\Http\Controllers\Api\V1\BoardController;
use App\Http\Controllers\Api\V1\CardController;
use App\Http\Controllers\Api\V1\ColumnController;
use App\Http\Controllers\Api\V1\MoveCardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return to_route('user.boards', auth()->user());
})->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::view('user/{user}/boards', 'boards.index')->name('user.boards');
    Route::view('boards/{board}', 'boards.show')->name('user.boards.show');
});

Route::prefix('api')->group(function () {
    Route::prefix('v1')->group(function () {
        Route::prefix('user')->group(function () {
            Route::prefix('{user}')->group(function () {
                Route::apiResource('boards', BoardController::class)->only('index');
            });
        });
        Route::apiResource('boards', BoardController::class)->except('index');
        Route::apiResource('columns', ColumnController::class)->except('index', 'show');
        Route::apiResource('cards', CardController::class)->except('index');
        Route::patch('cards/{card}/move', MoveCardController::class);
    });
});

Auth::routes();
