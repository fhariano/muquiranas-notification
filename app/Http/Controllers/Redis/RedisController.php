<?php

namespace App\Http\Controllers\Redis;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class RedisController extends Controller
{
    public function clearRedis() {
        Redis::command('flushdb');
    }
}
