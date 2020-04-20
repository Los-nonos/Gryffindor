<?php


namespace Application\Events;

use Domain\Interfaces\Services\Notifications\NotificationInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailNotificationEventData extends Mailable
{
    use Queueable, SerializesModels;

    private NotificationInterface $emailDetail;

    public function __construct(NotificationInterface $emailNotification)
    {
        $this->emailDetail = $emailNotification;
    }

    public function build(){
        return $this->view('email.test')
                    ->from(with(array(
                        'email' => $this->emailDetail->getEmail(),
                        'name' => $this->emailDetail->getName() . " " . $this->emailDetail->getSurname(),
                    )))
                    ->with([
                        'subject' => $this->emailDetail->getSubject(),
                        'message' => $this->emailDetail->getMessage(),
                    ]);
    }
}
