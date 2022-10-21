<?php

use App\Http\Controllers\Mails\EmailJobController;
use App\Http\Controllers\Redis\RedisController;
use App\Http\Controllers\Sms\SmsJobController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('horizon');
})->middleware('auth');

Auth::routes();

Route::get('send-email', [EmailJobController::class, 'enqueue']);
Route::get('send-sms', [SmsJobController::class, 'enqueue']);
Route::get('redis-clear', [RedisController::class, 'clearRedis']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
