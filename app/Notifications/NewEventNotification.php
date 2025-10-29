<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewEventNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $event;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($event)
    {
        $this->event = $event->load('createdBy');
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
        return (new MailMessage)
                ->subject('New Event Created')
                ->greeting('Hello ' . $notifiable->name . ',')
                ->line('A new event has been created.')
                ->line('Event Title: ' . $this->event->title)
                ->line('Event Start Date: ' . $this->event->start_at)
                ->line('Event End Date: ' . $this->event->end_at)
                ->line('Event Description: ' . $this->event->description)
                ->line('Event Created By: ' . $this->event->createdBy->name)
                ->action('View Event', url('/events/' . $this->event->id))
                // ->line('Thank you for using our application!')
                ->salutation('Regards, ' . config('app.name') . ' Team')
                ->from(config('mail.from.address'), config('mail.from.name'));
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
