<?php


namespace Application\Events;



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
        //devolver un value object con prioridades no con las funciones concretas.
        //depender de abstracciones nunca de implementaciones

        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            //Deberia poder obtener el email del UserId -> se me ato la rama
            ->from($this->notificationDetail->getUserId())
            //->greeting()
            ->line($this->notificationDetail->getSubject())
            ->action($this->notificationDetail->getMessageAction(),$this->notificationDetail->getUrlAction())
            ->line($this->notificationDetail->getMessage());
            //->line('Gracias por utilizar ZeepCommerce!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'userId'=> $this->notificationDetail->getUserId(),
            'action'=> $this->notificationDetail->getMessageAction(),
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
