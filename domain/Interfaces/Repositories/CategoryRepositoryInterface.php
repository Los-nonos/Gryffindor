<?php


namespace Domain\Interfaces\Repositories;


use Domain\Entities\Category;

interface CategoryRepositoryInterface
{
    public function persist(Category $category): void;

    public function findOneById($id): ?Category;

    public function indexAndPaginated($page, $size): array;
}
