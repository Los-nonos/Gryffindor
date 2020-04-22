<?php


namespace Application\Jobs;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notifiable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;


class InternalNotificationJob implements ShouldQueue
{
    use Notifiable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle($data)
    {
        /*Investigar como implementar la funcion de envio de notificaciones
          un Job en este caso porque se trabaja con colas de procesos */

        //Notification::send();
    }
}
