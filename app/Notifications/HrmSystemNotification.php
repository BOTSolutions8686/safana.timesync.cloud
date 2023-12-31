<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class HrmSystemNotification extends Notification
{
    use Queueable;

    private $details;
    private $notification_for;
   
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($details,$notification_for=null)
    {
        $this->details = $details;
        $this->notification_for = $details;
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
    public function toArray($notifiable)
    {
        return [
            'id' =>@$this->details['id'],
            'title' =>@$this->details['title'],
            'body' =>$this->details['body'],
            'actionText' =>$this->details['actionText'],
            'actionURL' =>$this->details['actionURL'],
            'sender_id' =>$this->details['sender_id'],
        ];
    }
}
