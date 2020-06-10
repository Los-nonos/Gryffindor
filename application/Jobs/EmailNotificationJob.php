<?php


namespace Application\Jobs;

use Domain\Interfaces\Services\Notifications\NotifiableInterface;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use SendGrid;

class EmailNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var NotifiableInterface
     */
    private $notifiable;

    public function __construct(NotifiableInterface $data)
    {
        $this->notifiable = $data;
    }

    public function handle()
    {
        $email = new SendGrid\Mail\Mail();
        $email->setFrom($this->notifiable->getEmailFrom(), $this->notifiable->getNameFrom());

        $email->setTemplateId(new \SendGrid\Mail\TemplateId('d-067793c0ec6b411b91db8b928977a2ce'));

        $personalization = new \SendGrid\Mail\Personalization();

        $to = new \SendGrid\Mail\To($this->notifiable->getEmail(), $this->notifiable->getName());
        $subject = new \SendGrid\Mail\Subject($this->notifiable->getSubject());

        //add email to and subject
        $personalization->addTo($to);

        //add data
        $personalization->addSubstitution('name', $this->notifiable->getName());
        $personalization->addSubstitution('message', $this->notifiable->getMessage());
        $personalization->addSubstitution('subject', $this->notifiable->getSubject());

        $email->addPersonalization($personalization);

        $dispatcher = new SendGrid(env('SENDGRID_API_KEY'));
        try {
            $response = $dispatcher->send($email);
        }catch (Exception $exception)
        {

        }
    }
}
