<?php


namespace Domain\Interfaces\Repositories;


use Domain\Entities\Provider;

interface ProviderRepositoryInterfaces
{
    public function persist (Provider $provider) : void;
}
