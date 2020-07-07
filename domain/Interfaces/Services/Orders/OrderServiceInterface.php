<?php


namespace Domain\Interfaces\Services\Orders;


interface OrderServiceInterface
{
    public function indexAndFiltered($page, $size, $userId): array;

    public function indexAll($page, $size): array;
}
