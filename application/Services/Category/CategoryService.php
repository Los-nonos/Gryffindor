<?php


namespace Application\Services\Category;


use Application\Exceptions\EntityNotFoundException;
use Domain\Entities\Category;
use Domain\Interfaces\Repositories\CategoryRepositoryInterface;

class CategoryService implements CategoryServiceInterface
{
    private CategoryRepositoryInterface $repository;

    public function __construct(
        CategoryRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    public function persist(Category $category): void
    {
        $this->repository->persist($category);
    }

    /**
     * @param $id
     * @return Category
     * @throws EntityNotFoundException
     */
    public function findOneByIdOrFail($id): Category
    {
        $category = $this->repository->findOneById($id);

        if(!isset($category))
        {
            throw new EntityNotFoundException("Category with id $id not found");
        }

        return $category;
    }

    public function indexAndPaginated($page, $size): array
    {
        $page = $page ? $page : 1;
        $size = $size ? $size : 10;

        return $this->repository->indexAndPaginated($page, $size);
    }

    public function destroy(Category $category)
    {
        $this->repository->destroy($category);
    }
}
