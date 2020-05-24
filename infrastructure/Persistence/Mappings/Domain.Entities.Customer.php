<?php


use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;

$builder = new ClassMetadataBuilder($metadata);
$builder->setTable('customers');
$builder->createField('id', Type::INTEGER)
    ->makePrimaryKey()
    ->generatedValue()
    ->build();

$builder->addField('uuid', Type::STRING);

$builder->addField('email', Type::STRING);
