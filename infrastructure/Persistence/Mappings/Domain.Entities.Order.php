<?php

use Doctrine\DBAL\Types\Types as Type;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Doctrine\ORM\Mapping\ClassMetadata;
use Domain\Entities\Order;
use Domain\Entities\Product;
use Domain\Entities\User;

$builder = new ClassMetadataBuilder(new ClassMetadata(Order::class));
$builder->setTable('orders');
$builder->createField('id', Type::INTEGER)
    ->makePrimaryKey()
    ->generatedValue()
    ->build();

$builder->createManyToOne('products', Product::class)
    ->cascadePersist()
    ->inversedBy('orders')
    ->build();

$builder->createOneToOne('customer', User::class)
    ->cascadePersist()
    ->build();

$builder->createOneToOne('seller', User::class)
    ->cascadePersist()
    ->build();

$builder->addField('amount', Type::FLOAT);
