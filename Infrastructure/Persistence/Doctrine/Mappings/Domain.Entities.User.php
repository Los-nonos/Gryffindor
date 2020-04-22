<?php

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Domain\Entities\Manager;
use Domain\Entities\Teacher;
use Persistence\Doctrine\CurrentTimestampBuilder;
use Domain\Entities\CompanyAdmin;

$builder = new ClassMetadataBuilder($metadata);
$builder->setTable('users');
$builder->createField('id', Type::INTEGER)
    ->makePrimaryKey()
    ->generatedValue()
    ->build();

$builder->addField('name', Type::STRING);

$builder->addField('surname', Type::STRING);

$builder->addField('username', Type::STRING);

$builder->addField('email', Type::STRING);

$builder->addField('password', Type::STRING);

$builder->addField('isActive', Type::BOOLEAN);
