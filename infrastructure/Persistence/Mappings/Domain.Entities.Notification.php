<?php

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;

$builder = new ClassMetadataBuilder($metadata);
$builder->setTable('notifications');

$builder->createField('id', Type::INTEGER)
    ->makePrimaryKey()
    ->generatedValue()
    ->build();

$builder->addField('message', Type::STRING);

$builder->addField('email', Type::STRING);

$builder->addField('role', Type::STRING);

$builder->addField('read', Type::BOOLEAN);
