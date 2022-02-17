<?php

namespace App\Notifications;

use App\Models\SurveyAnswer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SurveyAnsweredNotification extends Notification
{
    use Queueable;

    private $surveyAnswer;

    public function __construct(SurveyAnswer $surveyAnswer)
    {
        $this->surveyAnswer = $surveyAnswer;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $mail = (new MailMessage);
        $mail->line('Your survey is answer by ' . $this->surveyAnswer->user->name . '(' . $this->surveyAnswer->user->email . ').');
        $mail->line('');
        $mail->line('');

        foreach ($this->surveyAnswer->answers as $answer) {
            $mail->line($answer->form->name . ': ' . $answer->answer);
        }

        $mail->line('');
        $mail->line('');
        $mail->line('Thank you for using our application!');

        return $mail;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
