<?php


namespace Application\Events;

use Domain\Interfaces\Services\Notifications\NotifiableInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailNotificationEventData extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private NotifiableInterface $emailDetail;

    public function __construct(NotifiableInterface $emailNotification)
    {
        $this->emailDetail = $emailNotification;
    }

    public function build(){
        return $this->view('email.test')
                    ->from(with(array(
                        'email' => $this->emailDetail->getEmailFrom(),
                        'name' => $this->emailDetail->getNameFrom(),
                    )))
                    ->with([
                        'subject' => $this->emailDetail->getSubject(),
                        'message' => $this->emailDetail->getMessage(),
                    ])->to($this->emailDetail->getEmail());
    }
}
