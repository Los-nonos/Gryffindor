<?php

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Doctrine\ORM\Mapping\ClassMetadata;
use Domain\Entities\Category;
use Domain\Entities\Filter;
use Domain\Entities\Product;

$builder = new ClassMetadataBuilder(new ClassMetadata(Category::class));
$builder->setTable('categories');
$builder->createField('id', Type::INTEGER)
    ->makePrimaryKey()
    ->generatedValue()
    ->build();

$builder->addField('name', Type::STRING);

$builder->createOneToMany('filters', Filter::class)
    ->cascadePersist()
    ->inversedBy('category')
    ->build();

$builder->createManyToOne('products', Product::class)
    ->cascadePersist()
    ->inversedBy('categories')
    ->build();
