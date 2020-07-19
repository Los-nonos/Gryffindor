<?php


use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Domain\Entities\Order;

$builder = new ClassMetadataBuilder($metadata);
$builder->setTable('customers');
$builder->createField('id', Type::INTEGER)
    ->makePrimaryKey()
    ->generatedValue()
    ->build();

$builder->createField('uuid', Type::GUID)
    ->generatedValue()
    ->build();

$builder->addField('email', Type::STRING);

$builder->addField('age', Type::INTEGER);

$builder->addField('cellPhone', Type::STRING);

$builder->addField('dni', Type::STRING);

$builder->addField('cuil', Type::STRING);

$builder->addField('birthday', Type::DATETIME);

$builder->addField('postalCode', Type::STRING);

$builder->addField('country', Type::STRING);

$builder->addField('state', Type::STRING);

$builder->addField('city', Type::STRING);

$builder->addField('vatCondition', Type::STRING);

$builder->addField('grossIncome', Type::STRING);

$builder->createOneToMany('orders', Order::class)
    ->cascadePersist()
    ->cascadeRemove()
    ->mappedBy('customer')
    ->build();
