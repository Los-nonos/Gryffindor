<?php

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Domain\Entities\Category;
use Domain\Entities\Product;

$builder = new ClassMetadataBuilder($metadata);
$builder->setTable('categories');
$builder->createField('id', Type::INTEGER)
    ->makePrimaryKey()
    ->generatedValue()
    ->build();

$builder->createOneToMany('filters', Category::class)
    ->cascadePersist()
    ->build();

$builder->createOneToMany('products', Product::class)
    ->cascadePersist()
    ->build();
