<?php

namespace App\Listeners;

use App\Events\ResponseCreated;
use App\Mail\ResponseEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendResponseEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ResponseCreated $event): void
    {
        $response = $event->response;
        Mail::to($response->user->email)->send(new ResponseEmail($response));
    }
}
