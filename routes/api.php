<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Maincontroller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register',[Maincontroller::class,'register']);
Route::post('/login',[Maincontroller::class,'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware'=>['auth:sanctum']], function () {

Route::post('/store/contact',[Maincontroller::class,'storecontact']);
Route::post('/store/deletecontact',[Maincontroller::class,'deletecontact']);
Route::post('/store/updatecontact',[Maincontroller::class,'updatecontact']);
Route::get('/contact/{id}',[Maincontroller::class,'contactdetail']);

});