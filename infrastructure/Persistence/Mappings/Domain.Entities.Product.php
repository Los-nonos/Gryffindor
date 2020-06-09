<?php

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Doctrine\ORM\Mapping\ClassMetadata;
use Domain\Entities\Category;
use Domain\Entities\Characteristic;
use Domain\Entities\Order;
use Domain\Entities\Product;
use Domain\Entities\Stock;

$builder = new ClassMetadataBuilder(new ClassMetadata(Product::class));
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
    ->inversedBy('products')
    ->build();

$builder->createOneToOne('stock', Stock::class)
    ->cascadePersist()
    ->build();

$builder->createOneToMany('orders', Order::class)
    ->inversedBy('products')
    ->build();

$builder->createOneToMany('characteristics', Characteristic::class)
    ->cascadePersist()
    ->inversedBy('product')
    ->build();
