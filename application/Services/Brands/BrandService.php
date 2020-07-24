<?php


namespace Application\Services\Brands;


use Application\Exceptions\EntityNotFoundException;
use Domain\Entities\Brand;
use Domain\Interfaces\Repositories\BrandRepositoryInterface;
use Domain\Interfaces\Services\Brands\BrandServiceInterface;

class BrandService implements BrandServiceInterface
{
    /**
     * @var BrandRepositoryInterface
     */
    private BrandRepositoryInterface $repository;

    public function __construct(BrandRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


    public function findOneByIdOrFail(int $id): Brand
    {
        $brand = $this->repository->findOneById($id);

        if(!$brand) {
            throw new EntityNotFoundException("Brand with id: $id not found");
        }

        return $brand;
    }


    public function persist(Brand $brand): void
    {
        $this->repository->persist($brand);
    }

    public function findAllPaginated($page, $size): array
    {
        $page = $page ? $page : 1;
        $size = $size ? $size : 10;

        return $this->repository->findAllPaginated($page, $size);
    }

    public function findByNameOrFail(string $name): Brand
    {
        $brand = $this->repository->findOneByName($name);

        if(!$brand) {
            throw new EntityNotFoundException("Brand with name: $name not found");
        }

        return $brand;
    }

    public function destroy(Brand $brand)
    {
        $this->repository->destroy($brand);
    }
}
