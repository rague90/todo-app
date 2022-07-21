<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*use Illuminate\http\Controllers\ContactController;*/
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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::get('contacts',[App\Http\Controllers\ContactController::class,'getContacts']);
Route::post('save_contact',[App\Http\Controllers\ContactController::class,'saveContact']);
Route::get('get_contact/{id}',[App\Http\Controllers\ContactController::class,'getContact']);
Route::get('getcontact/{id}',[App\Http\Controllers\ContactController::class,'get_contact']);
Route::delete('delete_Contact/{id}',[App\Http\Controllers\ContactController::class,'deleteContact']);
Route::post('update_contact/{id}',[App\Http\Controllers\ContactController::class,'UpdateContact']);
