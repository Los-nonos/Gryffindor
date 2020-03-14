<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Doctrine\Repositories;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use Domain\Entities\Tag;
use Domain\Interfaces\TagRepositoryInterface;

class TagRepository extends EntityRepository implements TagRepositoryInterface
{

    public function __construct(EntityManager $em)
    {
        parent::__construct($em, new Mapping\ClassMetadata(Tag::class));
    }

    public function save(Tag $tag)
    {
        $this->getEntityManager()->persist($tag);
        $this->getEntityManager()->flush($tag);
    }

    public function getById(int $id): ?Tag
    {
        return $this->find($id);
    }

    public function getByName(string $name): ?Tag
    {
        $tag = $this->findOneBy(['name' => $name]);

        if (!$tag) {
            throw new EntityNotFoundException("Tag doesn't exists");
        }
        return $tag;
    }

    public function existWithTheName(string $name): bool
    {
        $tag = $this->findBy(['name' => $name]);

        if (!$tag) {
            return false;
        }
        return true;
    }

    public function getAll(): array
    {
        return $this->findAll();
    }
}
