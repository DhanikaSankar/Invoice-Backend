<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout',[LoginController::class,'logout']);
    Route::post('add',[DashboardController::class,'addInvoice']);
    Route::get('index',[DashboardController::class,'index']);
    Route::get('view/{id}',[DashboardController::class,'view']);
    Route::put('edit/{id}',[DashboardController::class,'edit']);
    Route::delete('sales-invoice/{id}',[DashboardController::class,'deleteInvoice']);
});

Route::post('login',[LoginController::class,'login']);
