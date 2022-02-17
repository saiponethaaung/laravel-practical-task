<?php

namespace App\Listeners;

use App\Events\SurveyAnswered;
use App\Models\SurveyAnswer;
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
        $surveyAnswer = SurveyAnswer::with([
            'user',
            'survey',
            'survey.owner',
            'answers',
            'answers.form'
        ])->find($event->answer);

        $surveyAnswer->survey->owner->notify(new SurveyAnsweredNotification($surveyAnswer));
    }
}
