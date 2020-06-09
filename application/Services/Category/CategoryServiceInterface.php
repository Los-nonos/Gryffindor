<?php


namespace Application\Services\Category;


use Domain\Entities\Category;

interface CategoryServiceInterface
{
    public function persist(Category $category): void;

    public function findOneByIdOrFail($id): Category;

    public function indexAndPaginated($page, $size): array;
}
