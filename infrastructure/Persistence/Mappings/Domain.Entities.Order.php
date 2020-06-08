<?php

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Domain\Entities\Product;
use Domain\Entities\User;

$builder = new ClassMetadataBuilder($metadata);
$builder->setTable('products');

$builder->createField('id', Type::INTEGER)
    ->makePrimaryKey()
    ->generatedValue()
    ->build();

$builder->createOneToMany('products', Product::class)
    ->cascadePersist()
    ->build();

$builder->createOneToOne('customer', User::class)
    ->cascadePersist()
    ->build();

$builder->createOneToOne('seller', User::class)
    ->cascadePersist()
    ->build();

$builder->addField('amount', Type::FLOAT);
