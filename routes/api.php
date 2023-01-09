<?php

use App\Http\Controllers\Api\CardFilterController;
use App\Http\Middleware\ValidateAccessToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(ValidateAccessToken::class)->group(function () {
    Route::get('list-cards', CardFilterController::class);
});