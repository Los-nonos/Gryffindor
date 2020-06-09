<?php

use Doctrine\DBAL\Types\Types as Type;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Doctrine\ORM\Mapping\ClassMetadata;
use Domain\Entities\Category;
use Domain\Entities\Filter;
use Domain\Entities\FilterOption;

$builder = new ClassMetadataBuilder($metadata);
$builder->setTable('filters');

$builder->createField('id', Type::INTEGER)
    ->makePrimaryKey()
    ->generatedValue()
    ->build();

$builder->createManyToOne('category', Category::class)
    ->cascadePersist()
    ->inversedBy('filters')
    ->build();

$builder->addField('name', Type::STRING);

$builder->createOneToMany('options', FilterOption::class)
    ->cascadePersist()
    ->inversedBy('filter')
    ->mappedBy('options')
    ->build();
