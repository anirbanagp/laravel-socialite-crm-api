<?php

namespace App\Listeners;

use App\Events\UserCreateEvent;
use App\Mail\WelcomeUsers;
use App\Mail\VerifyUserEmail;
use App\Http\Traits\DataSaver;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class UserCreateEventListener
{
    use DataSaver;
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
     * @param  UserCreateEvent  $event
     * @return void
     */
    public function handle(UserCreateEvent $event)
    {
        if($event->user->auth_provider == 'email') {
            $mailClass  =   new VerifyUserEmail($event->user);
        } else {
            $mailClass  =   new WelcomeUsers($event->user);
        }

        $to_email = $event->user->email;
        Mail::to($to_email)->queue($mailClass);
        $this->log('welcome mail sent', $event->user->id);
    }
}
