<?php


namespace Application\Events;



use Domain\Enums\Priority;
use Domain\Interfaces\Services\Notifications\NotifiableInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InternalNotificationEventData extends Notification implements ShouldQueue
{
    use Queueable;

    private NotifiableInterface $notificationDetail;

    public function __construct(NotifiableInterface $notification)
    {
        $this->notificationDetail = $notification;
    }


    public function via($notifiable)
    {
        if($this->notificationDetail->getPriority() === Priority::HIGH)
        {
            return ['mail'];
        }
        if ($this->notificationDetail->getPriority() === Priority::MIDDLE)
        {
            return ['database'];
        }
        if($this->notificationDetail->getPriority() === Priority::LOW)
        {
            return ['database'];
        }

    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->from($this->notificationDetail->getUserId())
            //->greeting()
            ->line($this->notificationDetail->getSubject())
            ->action($this->notificationDetail->getMessage(),$this->notificationDetail->getUrlAction());
            //->line($this->notificationDetail->getMessage());
            //->line('Gracias por utilizar ZeepCommerce!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'userId'=> $this->notificationDetail->getUserId(),
            'subject'=> $this->notificationDetail->getSubject(),
            'action'=> $this->notificationDetail->getMessage(),
            'urlAction'=>$this->notificationDetail->getUrlAction()
        ];
    }

    /*
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
    */
}
