<?php

use Doctrine\DBAL\Types\Types as Type;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Doctrine\ORM\Mapping\ClassMetadata;
use Domain\Entities\Category;
use Domain\Entities\Characteristic;
use Domain\Entities\Order;
use Domain\Entities\Product;
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

$builder->createManyToMany('categories', Category::class)
    ->inversedBy('products')
    ->build();

$builder->createOneToOne('stock', Stock::class)
    ->cascadePersist()
    ->build();

//$builder->createOneToMany('orders', Order::class)
//    ->inversedBy('products')
//    ->mappedBy('orders')
//    ->build();

$builder->addOneToMany('characteristics', Characteristic::class, 'product');
