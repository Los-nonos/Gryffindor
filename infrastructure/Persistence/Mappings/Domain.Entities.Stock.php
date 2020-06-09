<?php

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Doctrine\ORM\Mapping\ClassMetadata;
use Domain\Entities\Product;

$builder = new ClassMetadataBuilder(new ClassMetadata(\Domain\Entities\Stock::class));
$builder->setTable('stocks');
$builder->createField('id', Type::INTEGER)
    ->makePrimaryKey()
    ->generatedValue()
    ->build();

$builder->createOneToOne('product', Product::class)
    ->cascadePersist()
    ->build();

$builder->addField('quantity', Type::INTEGER);

$builder->addField('remanentQuantity', Type::INTEGER);
