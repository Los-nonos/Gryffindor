<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Doctrine\Repositories;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use Domain\Entities\Course;
use Domain\Interfaces\CourseRepositoryInterface;
use Infrastructure\Persistence\Doctrine\Queries\CourseQueryBuilder;

class CourseRepository extends EntityRepository implements CourseRepositoryInterface
{

    public function __construct(EntityManager $em)
    {
        parent::__construct($em, new Mapping\ClassMetadata(Course::class));
    }

    public function save(Course $course)
    {
        $this->getEntityManager()->persist($course);
        $this->getEntityManager()->flush();
    }

    public function update()
    {
        $this->getEntityManager()->flush();
    }

    public function getById(int $id): ?Course
    {
        $course = $this->find($id);

        if (!$course) {
            throw new EntityNotFoundException('course not found');
        }

        return $course;
    }

    public function getByName(string $name): ?Course
    {
        return $this->findOneBy(['name' => $name]);
    }

    public function getByQuery(string $query = null, Collection $tags = null, Collection $categories = null): array
    {
        $courseQueryBuilder = new CourseQueryBuilder($this->getEntityManager());
        if ($query) {
            $courseQueryBuilder->byQuery($query);
        }
        if ($tags) {
            $courseQueryBuilder->byTags($tags);
        }
        if ($categories) {
            $courseQueryBuilder->byCategories($categories);
        }
        return $courseQueryBuilder->executeQueryBuilder();
    }

    public function existWithTheName(string $name): bool
    {
        $course = $this->findBy(['name' => $name]);

        if (!$course) {
            return false;
        }
        return true;
    }

    public function getAll(): array
    {
        return $this->findAll();
    }

    public function cancel(Course $course): ?Course
    {
        $course->setAvailable(false);

        $this->getEntityManager()->flush();

        return $course;
    }
}
