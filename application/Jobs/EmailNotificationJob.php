<?php


namespace Application\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EmailNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;

    public function handle()
    {
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom("zeeporganization@gmail.com", "Zeeper");
        $email->addTo("ayrtoncravero26@gmail.com", "Ayrton Cravero");
        $email->setSubject("try usage sendgrid");
        $email->addContent("text/plain", "");
        $email->addContent(
            "text/html", view('email.test')->with($this->data)
        );
        $dispatcher = new \SendGrid(env('SENDGRID_API_KEY'));
        try {
            $response = $dispatcher->send($email);
        }catch (\Exception $exception)
        {

        }
    }

    public function __construct($data)
    {
        $this->data = $data;
    }
}
