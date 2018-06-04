<?php

namespace BluesFlix\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;

class DefaultResetPasswordNotification extends ResetPassword
{


    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Redefinição de senha')
                    ->line('Você está recebendo este e-mail, porque uma redefinição de senha foi requisitada.')
                    ->action('Redefinir senha', route('password.reset', $this->token))
                    ->line('Se você não rquisitou isto, por favor desconcidere.');
    }

}
