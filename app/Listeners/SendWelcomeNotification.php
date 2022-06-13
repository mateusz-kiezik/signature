<?php

namespace App\Listeners;

use App\Events\UserCompletedRegistration;
use App\Notifications\WelcomeEmailNotification;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendWelcomeNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Verified  $event
     * @return void
     */
    public function handle(Verified $event)
    {
        if ($event->user->hasVerifiedEmail()) {
            Notification::send($event->user, new WelcomeEmailNotification($event->user));
        }
    }
}
