<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewReferenceController;
use App\Http\Controllers\LoadController;

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

//Frontend Api Start Here 
            
        Route::match(['get','post'],'/ref/{id}', [NewReferenceController::class, 'showload']);
        Route::match(['get','post'],'/refd', [NewReferenceController::class, 'showload']);
        Route::match(['get','post'],'/refuser', [NewReferenceController::class, 'showudata']);

    
    //Api End Here 