<?php


namespace Domain\Interfaces\Repositories;


use Domain\Entities\Provider;

interface ProviderRepositoryInterface
{
    public function persist (Provider $provider) : void;

    public function findOneById(int $id): ?Provider;

    public function findAllPaginated($page, $size): array;
}
