<?php


namespace Domain\Interfaces\Services\Orders;


interface OrderServiceInterface
{
    public function indexAndFiltered($page, $size, $userId): array;
}
