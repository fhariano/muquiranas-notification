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
        $details = ['email' => $request->email, 'subject' => $request->subject, 'body' => $request->message];
        SendEmail::dispatch($details)->onQueue('emails');
    }

    public function sendMessage($email, $subject, $message)
    {
        $details = ['email' => $email, 'subject' => $subject, 'body' => $message];
        SendEmail::dispatch($details)->onQueue('emails');
    }
}
