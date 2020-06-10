<?php


namespace Domain\Interfaces\Repositories;


use Domain\Entities\Filter;

interface FilterRepositoryInterface
{
    public function persist(Filter $filter);

    public function destroy(Filter $item);
}
