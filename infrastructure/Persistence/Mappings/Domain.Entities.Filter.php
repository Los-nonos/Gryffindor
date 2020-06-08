<?php

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Domain\Entities\Category;
use Domain\Entities\FilterOption;

$builder = new ClassMetadataBuilder($metadata);
$builder->setTable('products');

$builder->createField('id', Type::INTEGER)
    ->makePrimaryKey()
    ->generatedValue()
    ->build();

$builder->createOneToOne('category', Category::class)
    ->cascadePersist()
    ->build();

$builder->addField('name', Type::STRING);

$builder->createOneToMany('options', FilterOption::class)
    ->cascadePersist()
    ->build();
