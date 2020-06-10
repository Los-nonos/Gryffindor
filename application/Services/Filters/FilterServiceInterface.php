<?php


namespace Application\Services\Filters;


use Domain\Entities\Filter;

interface FilterServiceInterface
{
    public function persist(Filter $filter): void;
}
