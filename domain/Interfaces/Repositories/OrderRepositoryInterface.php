<?php


namespace Domain\Interfaces\Repositories;


interface OrderRepositoryInterface
{
    public function indexAndFiltered(int $page, int $size, int $userId): array;
}
