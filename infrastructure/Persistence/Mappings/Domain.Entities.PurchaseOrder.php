<?php

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Doctrine\ORM\Mapping\ClassMetadata;
use Domain\Entities\Employee;
use Domain\Entities\Product;
use Domain\Entities\Provider;
use Domain\Entities\PurchaseOrder;

$builder = new ClassMetadataBuilder(new ClassMetadata(PurchaseOrder::class));
$builder->setTable('purchase_orders');

$builder->createField('id', Type::INTEGER)
    ->makePrimaryKey()
    ->generatedValue()
    ->build();

$builder->addField('amount', Type::INTEGER);

$builder->createManyToOne('provider', Provider::class)->inversedBy('orders')->build();

$builder->addField('purchaseNumber', Type::STRING);

$builder->addInverseManyToMany('products', Product::class, 'purchaseOrderNumber');

$builder->addManyToOne('buyerUser', Employee::class, 'purchaseOrders');
