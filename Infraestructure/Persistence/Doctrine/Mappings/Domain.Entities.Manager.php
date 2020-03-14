<?php

declare(strict_types=1);

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Domain\Entities\Department;
use Persistence\Doctrine\CurrentTimestampBuilder;

$builder = new ClassMetadataBuilder($metadata);
$builder->setTable('managers');
$builder->createField('id', Type::INTEGER)
    ->makePrimaryKey()
    ->generatedValue()
    ->build();

$builder->addField('firstName', Type::STRING);

$builder->addField('lastName', Type::STRING);

$builder->createManyToMany('departments', Department::class)
    ->cascadePersist()
    ->build();
