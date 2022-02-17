<?php

namespace App\Listeners;

use App\Events\SurveyAnswered;
use App\Models\User;
use App\Notifications\SurveyAnsweredNotification;

class SendAnswerToSurveyOwner
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
     * @param  object  $event
     * @return void
     */
    public function handle(SurveyAnswered $event)
    {
        if ($event->owner instanceof User) {
            $event->owner->notify(new SurveyAnsweredNotification($event->answers));
        }
    }
}
