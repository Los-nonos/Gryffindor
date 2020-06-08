<?php

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;

$builder = new ClassMetadataBuilder($metadata);
$builder->setTable('users');
$builder->createField('id', Type::INTEGER)
    ->makePrimaryKey()
    ->generatedValue()
    ->build();

$builder->addField('name', Type::STRING);

$builder->addField('property', Type::STRING);
