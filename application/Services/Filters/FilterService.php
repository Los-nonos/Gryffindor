<?php


namespace Application\Services\Filters;


use Domain\Entities\Filter;
use Domain\Interfaces\Repositories\FilterRepositoryInterface;

class FilterService implements FilterServiceInterface
{
    private FilterRepositoryInterface $repository;

    public function __construct(
        FilterRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    public function persist(Filter $filter): void
    {
        $this->repository->persist($filter);
    }

    public function destroy(Filter $item): void
    {
        $this->repository->destroy($item);
    }
}
