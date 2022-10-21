<?php

namespace App\Http\Controllers\Sms;

use App\Http\Controllers\Controller;
use App\Jobs\SendSms;
use Illuminate\Http\Request;

class SmsJobController extends Controller
{
    /**
     *
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function enqueue(Request $request)
    {
        $details = ['to' => $request->to, 'message' => $request->message];
        SendSms::dispatch($details)->onQueue('sms');
    }
}
