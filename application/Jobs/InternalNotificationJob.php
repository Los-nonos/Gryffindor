<?php


namespace Application\Jobs;


use Domain\Interfaces\Services\Notifications\NotifiableInterface;
use Domain\Interfaces\Services\Notifications\NotificationServiceInterface;
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

    /**
     * @var NotifiableInterface
     */
    private NotifiableInterface $notifiable;

    public function __construct(NotifiableInterface $notifiable)
    {
        $this->notifiable = $notifiable;
    }

    public function handle(NotificationServiceInterface $notificationService)
    {
        $notificationService->persist($this->notifiable->internalNotification());
    }
}
