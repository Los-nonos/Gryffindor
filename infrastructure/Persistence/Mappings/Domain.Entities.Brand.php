<?php

use Doctrine\DBAL\Types\Types as Type;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Domain\Entities\Product;
use Domain\Entities\Provider;

$builder = new ClassMetadataBuilder($metadata);
$builder->setTable('brands');
$builder->createField('id', Type::INTEGER)
    ->makePrimaryKey()
    ->generatedValue()
    ->build();
$builder->addField('name', Type::STRING);

$builder->addField('description' , Type::STRING);

$builder->addOneToMany('providers', Provider::class, 'providers');

$builder->addManyToOne('products', Product::class, 'brands');
