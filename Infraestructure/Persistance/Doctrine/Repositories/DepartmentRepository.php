<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Doctrine\Repositories;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use Domain\Entities\Department;
use Domain\Interfaces\DepartmentRepositoryInterface;

class DepartmentRepository extends EntityRepository implements DepartmentRepositoryInterface
{

    public function __construct(EntityManager $em)
    {
        parent::__construct($em, new Mapping\ClassMetadata(Department::class));
    }

    public function save(Department $department)
    {
        $this->getEntityManager()->persist($department);
        $this->getEntityManager()->flush();
    }

    public function getById(int $id): ?Department
    {
        $department = $this->find($id);

        if (!$department) {
            throw new EntityNotFoundException('department not found');
        }

        return $department;
    }

    public function getByName(string $name): ?Department
    {
        return $this->findOneBy(['name' => $name]);
    }

    public function existWithTheName(string $name): bool
    {
        $department = $this->findBy(['name' => $name]);

        if (!$department) {
            return false;
        }
        return true;
    }

    public function getAll(): array
    {
        return $this->findAll();
    }
}
