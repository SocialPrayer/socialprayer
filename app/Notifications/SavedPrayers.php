<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SavedPrayers extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($numOfSavedPrayers, $userid) {
        $this->numOfSavedPrayers = $numOfSavedPrayers;
        $this->userid = $userid;
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
            $user = \App\User::find($this->userid);

            $url = url('/prayers/prayers-for-later');
            return (new MailMessage)
                ->subject('SocialPrayer - ' . $this->numOfSavedPrayers . ' saved prayer(s) to pray for')
                ->greeting('Hello ' . $user->name . ',')
                ->line('You have ' . $this->numOfSavedPrayers . ' prayer(s) waiting for you. These are prayers that you marked for pray later.')
                ->action('Go To Prayers', $url)
                ->line('Have a blessed day!');
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
