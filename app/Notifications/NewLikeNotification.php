<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewLikeNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $like, $likeableType;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($like, $likeableType)
    {
        $this->like = $like->load(['likeable.user', 'user']);
        $this->likeableType = $likeableType;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
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
                    ->subject($this->like->user->name.' liked your post')
                    ->line('Hi! '.$this->like->likeable->user->name)
                    ->line($this->like->user->name.' liked your post')
                    ->action('View Post', url('/posts/'.    $this->like->likeable->id))
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
                'id' => $this->like->id,
                'likeable_id' => $this->like->likeable->id,
                'likeable_type' => $this->likeableType,
                'liker' => $this->like->user->name,
                'liker_id' => $this->like->user->id,
                'created_at' => $this->like->created_at,
            ];
    }
}
