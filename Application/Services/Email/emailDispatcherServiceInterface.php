<?php


namespace Application\Services\Email;


interface emailDispatcherServiceInterface
{
    public function handle($emailDetail);
}
