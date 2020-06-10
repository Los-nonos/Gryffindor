<?php

use Doctrine\DBAL\Types\Types as Type;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Domain\Entities\Filter;
use Domain\Entities\Product;

$builder = new ClassMetadataBuilder($metadata);
$builder->setTable('categories');
$builder->createField('id', Type::INTEGER)
    ->makePrimaryKey()
    ->generatedValue()
    ->build();

$builder->addField('name', Type::STRING);

$builder->createOneToMany('filters', Filter::class)
    ->mappedBy('category')
    ->cascadePersist()
    ->addJoinColumn('filters', 'id')
    ->build();

$builder->addInverseManyToMany('products', Product::class, 'categories');
