<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Notification;

class MailResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
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
        $link = url('/reset/' . $this->token);

        return (new MailMessage)
            ->greeting('Olá!')
            ->subject('Redefinir Senha')
            ->line("Olá! Você está recebendo este e-mail porque recebemos uma solicitação de redefinição de senha para sua conta.")
            ->action('Redefinir Senha', $link)
            ->line("Este link de redefinição de senha expirará em " . config('auth.passwords.users.expire') . " minutos")
            ->line("Se você não solicitou uma redefinição de senha, nenhuma ação adicional será necessária.");
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
