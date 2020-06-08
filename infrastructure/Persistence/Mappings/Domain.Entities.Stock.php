<?php

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Domain\Entities\Product;

$builder = new ClassMetadataBuilder($metadata);
$builder->setTable('users');
$builder->createField('id', Type::INTEGER)
    ->makePrimaryKey()
    ->generatedValue()
    ->build();

$builder->createOneToOne('product', Product::class)
    ->cascadePersist()
    ->build();

$builder->addField('quantity', Type::INTEGER);

$builder->addField('remanentQuantity', Type::INTEGER);
