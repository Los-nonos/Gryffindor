<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Doctrine\Repositories;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use Domain\Entities\Category;
use Domain\Interfaces\CategoryRepositoryInterface;

class CategoryRepository extends EntityRepository implements CategoryRepositoryInterface
{

    public function __construct(EntityManager $em)
    {
        parent::__construct($em, new Mapping\ClassMetadata(Category::class));
    }

    public function save(Category $category)
    {
        $this->getEntityManager()->persist($category);
        $this->getEntityManager()->flush($category);
    }

    public function getById(int $id): ?Category
    {
        return $this->find($id);
    }

    public function getByName(string $name): ?Category
    {
        $category = $this->findOneBy(['name' => $name]);

        if (!$category) {
            throw new EntityNotFoundException("Category doesn't exists");
        }
        return $category;
    }

    public function existWithTheName(string $name): bool
    {
        $category = $this->findBy(['name' => $name]);

        if (!$category) {
            return false;
        }
        return true;
    }

    public function getAll(): array
    {
        return $this->findAll();
    }
}
