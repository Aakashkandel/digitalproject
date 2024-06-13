<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BloodGroupController;
use App\Http\Controllers\ProvinceController;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

//addblood apis

Route::post('/addblood', [BloodGroupController::class, 'store']);
Route::get('/getblood', [BloodGroupController::class, 'index']);
Route::get('/getblood/{id}', [BloodGroupController::class, 'show']);
Route::put('/updateblood/{id}', [BloodGroupController::class, 'update']);
Route::delete('/deleteblood/{id}', [BloodGroupController::class, 'destroy']);


//province apis
Route::post('/addprovince',[ProvinceController::class,'store']);
Route::get('/getprovince',[ProvinceController::class,'index']);
Route::get('/getprovince/{id}',[ProvinceController::class,'show']);
Route::put('/updateprovince/{id}',[ProvinceController::class,'update']);
Route::delete('/deleteprovince/{id}',[ProvinceController::class,'destroy']);

