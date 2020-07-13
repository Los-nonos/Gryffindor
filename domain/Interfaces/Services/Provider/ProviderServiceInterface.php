<?php


namespace Domain\Interfaces\Services\Provider;


use Domain\Entities\Provider;

interface ProviderServiceInterface
{
    public function persist(Provider $provider): void;

    //TODO Terminar ProviderServiceInterface
}
