<?php


namespace Domain\Interfaces\Repositories;


use Domain\Entities\Order;

interface OrderRepositoryInterface
{
    public function indexAndFiltered(int $page, int $size, int $userId): array;

    public function indexAll(int $page, int $size);

    public function findByUuid(string $uuid);

    public function persist(Order $order);
}
