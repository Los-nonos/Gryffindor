<?php

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Doctrine\ORM\Mapping\ClassMetadata;
use Domain\Entities\Characteristic;
use Domain\Entities\Product;

$builder = new ClassMetadataBuilder($metadata);
$builder->setTable('characteristic');
$builder->createField('id', Type::INTEGER)
    ->makePrimaryKey()
    ->generatedValue()
    ->build();

$builder->addField('name', Type::STRING);

$builder->addField('property', Type::STRING);

$builder->createManyToOne('product', Product::class)
    ->inversedBy('characteristics')
    ->build();
