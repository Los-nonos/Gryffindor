<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Doctrine\Repositories;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Domain\Entities\Teacher;
use Domain\Interfaces\TeacherRepositoryInterface;
use Exception;

class TeacherRepository extends EntityRepository implements TeacherRepositoryInterface
{
    /**
     * DoctrineUserRepository constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, new ClassMetadata(Teacher::class));
    }

    /**
     * @param Teacher $teacher
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(Teacher $teacher): void
    {
        $this->getEntityManager()->persist($teacher);
        $this->getEntityManager()->flush();
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function update(): void
    {
        $this->getEntityManager()->flush();
    }

    /**
     * @param int $teacherId
     * @return Teacher|null
     * @throws Exception
     */
    public function getById(int $teacherId): ?Teacher
    {
        $teacher = $this->find($teacherId);

        if (!$teacher) {
            throw new Exception('Teacher not found');
        }

        return $teacher;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function all(): array
    {
        return $this->findAll();
    }
}
