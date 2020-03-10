<?php

declare(strict_types=1);

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Persistence\Doctrine\CurrentTimestampBuilder;

$builder = new ClassMetadataBuilder($metadata);
$builder->setTable('teacher');
$builder->createField('id', Type::INTEGER)
    ->makePrimaryKey()
    ->generatedValue()
    ->build();

$builder->addField('firstName', Type::STRING);

$builder->addField('lastName', Type::STRING);

$builder->addField('age', Type::SMALLINT);

$builder->addField('academyTraining', Type::STRING);
