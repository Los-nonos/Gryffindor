<?php


namespace Domain\Interfaces\Repositories;


use Domain\Entities\Provider;

interface ProviderRepositoryInterface
{
    public function persist (Provider $provider) : void;
}
