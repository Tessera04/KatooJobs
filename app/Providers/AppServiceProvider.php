<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function($notifiable, $url){
            return(new MailMessage)
                ->subject('Verificar Cuenta')
                ->line('Para verificar su cuenta, haga click en el siguiente enlace:')
                ->action('Verificar Cuenta', $url)
                ->line('Si no realizó el registro, ignore este correo.');
        });
    }
}
