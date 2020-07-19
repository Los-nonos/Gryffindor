<?php


namespace Domain\Interfaces\Services\Provider;


use Domain\Entities\Provider;

interface ProviderServiceInterface
{
    public function persist(Provider $provider): void;

    public function findOneByIdOrFail(int $id): Provider;

    public function findAllPaginated($page, $size);
}
