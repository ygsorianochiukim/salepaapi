<?php

use App\Http\Controllers\BuyersController;
use App\Http\Controllers\LotAvailabilitiesController;
use App\Http\Controllers\OTPCOntroller;
use App\Http\Controllers\PaymentInformationController;
use App\Http\Controllers\PurchaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('buyers', [BuyersController::class , 'storeBuyersDetails']);
Route::get('buyers', [BuyersController::class , 'displayBuyers']);

Route::post('purchase', [PurchaseController::class , 'storePurchaseDetails']);
Route::get('purchase/salesLookup/{id}', [PurchaseController::class , 'lookupSalesPa']);
Route::get('purchase/lookupName/{name}', [PurchaseController::class , 'lookupName']);
Route::get('purchase', [PurchaseController::class , 'displayPurchase']);

Route::get('/lots/availability', [LotAvailabilitiesController::class, 'getLotAvailability']);

Route::post('/otp', [OTPCOntroller::class, 'sendOtp']);

Route::post('payment', [PaymentInformationController::class , 'storePayment']);
Route::get('payment', [PaymentInformationController::class , 'displaypayment']);
