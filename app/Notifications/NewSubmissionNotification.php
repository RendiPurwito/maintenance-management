<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewSubmissionNotification extends Notification
{
    use Queueable;
    public $submitted;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($submitted)
    {
        $this->submitted = $submitted;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            // 'name'  => $this->submitted->user_id,
            // 'form' => $this->submitted->form_id,
            // 'submission_id' => $this->submitted->id,
            // 'message' => 'has just been submitted'
            'id' => $this->submitted->id,
            'name'  => auth()->user()->name,
            'message' => 'has just submitted form',
            'subject' => $this->submitted->form_id,
        ];
    }
}
