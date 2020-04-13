<?php


namespace Application\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Infrastructure\Email\SendGrid\SendGridEmail;

class EmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $emailDetail;

    public function __construct($emailDetail)
    {
        $this->emailDetail = $emailDetail;
    }
    
    public function handle()
    {
        $sendGridEmail = new SendGridEmail($this->emailDetail['data']);
        Mail::to($this->emailDetail['email'])->send($sendGridEmail);
    }
}
