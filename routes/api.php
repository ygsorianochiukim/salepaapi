<?php

use App\Http\Controllers\BuyersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('buyers', [BuyersController::class , 'storeBuyersDetails']);
Route::get('buyers', [BuyersController::class , 'displayBuyers']);
