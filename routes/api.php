<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserAuthController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

//Mes routes d'authentification (publiques)
Route::post('/register',[UserAuthController::class,'register']);
Route::post('/login',[UserAuthController::class,'login']);


//Mes routes protégées (nécessitent une authentification)
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
    });