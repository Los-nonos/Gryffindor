<?php

use Doctrine\DBAL\Types\Types as Type;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Doctrine\ORM\Mapping\ClassMetadata;
use Domain\Entities\Filter;
use Domain\Entities\FilterOption;

$builder = new ClassMetadataBuilder($metadata);
$builder->setTable('filter_options');

$builder->createField('id', Type::INTEGER)
    ->makePrimaryKey()
    ->generatedValue()
    ->build();

$builder->addField('name', Type::STRING);

$builder->createManyToOne('filter', Filter::class)
    ->cascadePersist()
    ->inversedBy('options')
    ->build();
