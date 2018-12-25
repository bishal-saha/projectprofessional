<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserRegistered extends Notification
{
    use Queueable;

    /**
     * @var User
     */
    private $registeredUser;

    /**
     * Create a new notification instance.
     *
     * @param User $registeredUser
     * @return void
     */
    public function __construct(User $registeredUser)
    {
        $this->registeredUser = $registeredUser;
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
        $subject = sprintf("[%s] %s", settings('app_name'),
            'New User Registration');

        return (new MailMessage)
                    ->subject($subject)
                    ->line('New user was just registered on '.settings('app_name').' website.')
                    ->line('To view user details just visit the link below:')
                    ->action('View User', route('user.show', $this->registeredUser->id))
                    ->line('Thank you for using our application.');
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
