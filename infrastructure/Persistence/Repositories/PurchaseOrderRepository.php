<?php


namespace Infrastructure\Persistence\Repositories;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use Domain\Entities\PurchaseOrder;
use Domain\Interfaces\Repositories\PurchaseOrderRepositoryInterface;

class PurchaseOrderRepository extends EntityRepository implements PurchaseOrderRepositoryInterface
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, new Mapping\ClassMetadata(PurchaseOrder::class));
    }
}
