<?php

namespace App\Jobs;

use App\Http\Controllers\Mails\EmailJobController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class SendSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $details;
    private $twilioClient;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
        $accound_id = config('twilio.account_sid');
        $auth_token = config('twilio.auth_token');
        
        $this->twilioClient = new Client($accound_id, $auth_token);
    }
    
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $details = $this->details;
        $receiver = $details["to"];
        $message = $details["message"];
        $twilio_number = config('twilio.from_phone_number');
        try {
            $this->twilioClient->messages->create(
                $receiver,
                array(
                    'from' => $twilio_number,
                    'body' => $message
                )
            );
        } catch (TwilioException $e) {
            Log::channel('notification')->error($e->getMessage());
            (new EmailJobController)->sendMessage('fhariano@gmail.com', '[Muqruirana\'s Bar] ERROR SEND SMS', $e->getMessage());
            return $e;
        }
    }
}
