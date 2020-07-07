<?php


namespace Domain\Interfaces\Services\Orders;


use Domain\Entities\Order;

interface OrderServiceInterface
{
    public function indexAndFiltered($page, $size, $userId): array;

    public function indexAll($page, $size): array;

    public function findByUuidOrFail(string $uuid): Order;
}
