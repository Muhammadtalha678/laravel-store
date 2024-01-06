<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\VerifyEmail;

class CustomEmailVerificationNotification extends VerifyEmail
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via( $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    // public function toMail(object $notifiable): MailMessage
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from('noreply@example.com', 'Jalal Store')
            ->subject('Verify Email Address')
            ->line('Welcome to our application. To get started, please verify your email address by clicking the button below:')
            ->action('Verify Email Address', $this->verificationUrl($notifiable))
            ->line('If you did not create an account, no further action is required.');

            // You can customize the email message as needed
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */                    
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
