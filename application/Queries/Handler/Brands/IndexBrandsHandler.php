<?php


namespace Application\Queries\Handler\Brands;


use Application\Queries\Query\Brands\IndexBrandsQuery;
use Application\Queries\Results\Brands\IndexBrandsResult;
use Domain\Interfaces\Services\Brands\BrandServiceInterface;
use Infrastructure\QueryBus\Handler\HandlerInterface;
use Infrastructure\QueryBus\Result\ResultInterface;

class IndexBrandsHandler implements HandlerInterface
{
    private BrandServiceInterface $service;

    public function __construct(BrandServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @param IndexBrandsQuery $query
     * @return ResultInterface
     */
    public function handle($query): ResultInterface
    {
        $brands = $this->service->findAllPaginated($query->getPage(), $query->getSize());

        return new IndexBrandsResult($brands);
    }
}
