<?php


namespace Application\Jobs;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;


class InternalNotificationJob implements ShouldQueue
{
    use Dispatchable, Notifiable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle($entity,$data)
    {


        Notification::send($entity,$data);
    }
}
