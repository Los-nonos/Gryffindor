<?php

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Persistence\Doctrine\CurrentTimestampBuilder;

$builder = new ClassMetadataBuilder($metadata);
$builder->setTable('organization');
$builder->createField('id', Type::INTEGER)
    ->makePrimaryKey()
    ->generatedValue()
    ->build();

$builder->addField('organizationName', Type::STRING);
