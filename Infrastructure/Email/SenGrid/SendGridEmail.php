<?php

namespace Infrastructure\Email\SendGrid;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendGridEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $emailData;

    public function __construct($emailData)
    {
        $this->emailData = $emailData;
    }

    public function build()
    {
        return $this->view('email.test')
            ->from('zeeporganization@gmail.com','ZeepOrganization')
            //->to('joaquinmartina44@gmail.com')
            ->subject('Prueba correo');
    }
}
