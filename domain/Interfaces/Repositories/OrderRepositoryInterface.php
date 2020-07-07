<?php


namespace Domain\Interfaces\Repositories;


interface OrderRepositoryInterface
{
    public function indexAndFiltered(int $page, int $size, int $userId): array;

    public function indexAll(int $page, int $size);

    public function findByUuid(string $uuid);
}
