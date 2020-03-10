<?php

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Persistence\Doctrine\CurrentTimestampBuilder;
use Domain\Entities\Organization;

$builder = new ClassMetadataBuilder($metadata);
$builder->setTable('companyAdmin');
$builder->createField('id', Type::INTEGER)
    ->makePrimaryKey()
    ->generatedValue()
    ->build();

$builder->createOneToOne('organization', Organization::class)
    ->cascadePersist()
    ->build();
