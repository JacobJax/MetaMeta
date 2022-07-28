<?php

use App\Http\Controllers\VoiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::any('event', [VoiceController::class, 'event']);
Route::any('callback', [VoiceController::class, 'callback']);
Route::any('dial_2', [VoiceController::class, 'dial_2']);
Route::any('dial_3', [VoiceController::class, 'dial_3']);

