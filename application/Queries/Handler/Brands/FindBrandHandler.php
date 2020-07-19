<?php


namespace Application\Queries\Handler\Brands;


use Application\Queries\Query\Brands\FindBrandQuery;
use Application\Queries\Results\Brands\FindBrandResult;
use Domain\Interfaces\Services\Brands\BrandServiceInterface;
use Infrastructure\QueryBus\Handler\HandlerInterface;
use Infrastructure\QueryBus\Query\QueryInterface;
use Infrastructure\QueryBus\Result\ResultInterface;

class FindBrandHandler implements HandlerInterface
{
    private BrandServiceInterface $service;

    public function __construct(BrandServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @param FindBrandQuery $query
     * @return ResultInterface
     */
    public function handle($query): ResultInterface
    {
        $brand = $this->service->findOneByIdOrFail($query->getId());

        return new FindBrandResult($brand);
    }
}
