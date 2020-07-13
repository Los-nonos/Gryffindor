<?php

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Domain\Entities\Order;
use Domain\Entities\PurchaseOrder;

$builder = new ClassMetadataBuilder($metadata);
$builder->setTable('employees');
$builder->createField('id', Type::INTEGER)
    ->makePrimaryKey()
    ->generatedValue()
    ->build();

$builder->addField('role', Type::STRING);

$builder->createOneToMany('orders', Order::class)
    ->cascadePersist()
    ->cascadeRemove()
    ->mappedBy('employee')
    ->build();

$builder->createOneToMany('purchaseOrders', PurchaseOrder::class)
    ->cascadePersist()
    ->cascadeRemove()
    ->mappedBy('buyerUser')
    ->build();
