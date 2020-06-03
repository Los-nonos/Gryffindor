<?php


namespace Presentation\Http\Actions;


use Application\Events\EmailNotificationEventData;
use Application\Services\Notification\NotifiableServiceInterface;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class SendEmail
{
    private NotifiableServiceInterface $notifiableService;

    public function __construct(
        NotifiableServiceInterface $notifiableService
    )
    {
        $this->notifiableService = $notifiableService;
    }

    public function __invoke()
    {
        $notifiable = $this->notifiableService->notificationNotificationData();
        $url = env('APP_URL', 'http://zeepcommerce.com');
        $companyName = env('APP_NAME', 'Zeep Commerce');
        $notifiable->setUrlAction($url);
        $notifiable->setSubject('Activate your account');
        $notifiable->setEmail("cristiandamianvena@gmail.com");
        $tokenActivateAccount = "$url/activate?token=";

        $notifiable->setMessage("Welcome to $companyName! \n please active your account here: $tokenActivateAccount \n this url is valid for one week only");
        //$this->notifiableService->sendEmail($notifiable);
        //Mail::send($notifiable->emailNotification());

        return "se envio el mail";
    }
}
