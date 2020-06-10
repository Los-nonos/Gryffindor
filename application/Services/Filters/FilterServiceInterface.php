<?php


namespace Application\Services\Filters;


use Domain\Entities\Filter;

interface FilterServiceInterface
{
    public function persist(Filter $filter): void;
    public function destroy(Filter $filter): void;
}
