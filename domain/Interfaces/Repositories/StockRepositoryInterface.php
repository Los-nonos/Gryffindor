<?php


namespace Domain\Interfaces\Repositories;


use Domain\Entities\Stock;

interface StockRepositoryInterface
{
    public function persist(Stock $stock): void;

    public function findOneById(int $id): ?Stock;

    public function findWithLowerStock(int $value): array;
}
