<?php

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Domain\Entities\Category;
use Domain\Entities\Characteristic;
use Domain\Entities\Stock;

$builder = new ClassMetadataBuilder($metadata);
$builder->setTable('products');
$builder->createField('id', Type::INTEGER)
    ->makePrimaryKey()
    ->generatedValue()
    ->build();

$builder->addField('title', Type::STRING);

$builder->addField('description', Type::STRING);

$builder->addField('price', Type::FLOAT);

$builder->addField('taxes', Type::FLOAT);

$builder->createOneToMany('categories', Category::class)
    ->cascadePersist()
    ->build();

$builder->createOneToOne('stock', Stock::class)
    ->cascadePersist()
    ->build();

$builder->createOneToMany('characteristics', Characteristic::class)
    ->cascadePersist()
    ->build();
