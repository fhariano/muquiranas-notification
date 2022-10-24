<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Mails\EmailJobController;
use App\Http\Controllers\Redis\RedisController;
use App\Http\Controllers\Sms\SmsJobController;
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
Route::post('/auth', [AuthController::class, 'auth']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('send-email', [EmailJobController::class, 'enqueue']);
    Route::get('send-sms', [SmsJobController::class, 'enqueue']);
    Route::get('redis-clear', [RedisController::class, 'clearRedis']);
});
