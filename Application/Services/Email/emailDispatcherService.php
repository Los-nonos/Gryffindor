<?php


namespace Application\Services\Email;

use Application\Jobs\EmailJob;

class emailDispatcherService implements emailDispatcherServiceInterface
{

    public function handle($emailDetail)
    {
        EmailJob::dispatch($emailDetail)->onQueue('emails');
    }
}
