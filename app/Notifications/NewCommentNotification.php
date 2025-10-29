<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCommentNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $comment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($comment)
    {
        // $this->comment = $comment;
        $this->comment = $comment->load(['commentable.user', 'user']);
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
                    ->subject($this->comment->user->name.' commented on your post')
                    ->line('Hi! '.$this->comment->commentable->user->name)
                    ->line($this->comment->user->name.' commented on your post')
                    ->line($this->comment->body)
                    ->action('View Post', url('/posts/'.    $this->comment->commentable->id))
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
            'post_id' => $this->comment->commentable->id,
            'commenter_id' => $this->comment->user->id,
            'commenter' => $this->comment->user->name,
            'comment_id' => $this->comment->id,
            'comment_body' => $this->comment->body,
            'created_at' => $this->comment->created_at,
        ];
    }
}
