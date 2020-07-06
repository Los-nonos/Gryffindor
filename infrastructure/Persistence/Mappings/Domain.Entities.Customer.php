<?php


use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;

$builder = new ClassMetadataBuilder($metadata);
$builder->setTable('customers');
$builder->createField('id', Type::INTEGER)
    ->makePrimaryKey()
    ->generatedValue()
    ->build();

$builder->addField('uuid', Type::GUID);

$builder->addField('email', Type::STRING);

$builder->addField('age', Type::INTEGER);

$builder->addField('cellPhone', Type::STRING);

$builder->addField('dni', Type::STRING);

$builder->addField('birthday', Type::DATETIME);

$builder->addField('postalCode', Type::STRING);

$builder->addField('country', Type::STRING);

$builder->addField('state', Type::STRING);

$builder->addField('city', Type::STRING);

$builder->addField('vatCondition', Type::STRING);

$builder->addField('grossIncome', Type::STRING);
