<?php

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Doctrine\ORM\Mapping\ClassMetadata;
use Domain\Entities\Filter;
use Domain\Entities\FilterOption;

$builder = new ClassMetadataBuilder(new ClassMetadata(FilterOption::class));
$builder->setTable('filter_options');

$builder->createField('id', Type::INTEGER)
    ->makePrimaryKey()
    ->generatedValue()
    ->build();

$builder->addField('name', Type::STRING);

$builder->createOneToMany('filter', Filter::class)->build();
