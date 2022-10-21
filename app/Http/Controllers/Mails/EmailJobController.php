<?php

namespace App\Http\Controllers\Mails;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmail;
use Illuminate\Http\Request;

class EmailJobController extends Controller
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
        $details = ['email' => $request->email, 'code' => $request->code];
        SendEmail::dispatch($details)->onQueue('emails');
    }
}
