<?php

use Doctrine\DBAL\Types\Types as Type;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Domain\Entities\Category;
use Domain\Entities\Characteristic;
use Domain\Entities\Purchaseorder;
use Domain\Entities\Stock;
use Domain\Entities\Provider;
use Domain\Entities\Brand;

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

$builder->createManyToMany('purchaseOrderNumber', PurchaseOrder::class)
    ->inversedBy('products')
    ->build();

$builder->addOneToMany('characteristics', Characteristic::class, 'product');

$builder->addOneToMany('providers', Provider::class,'product');

$builder->addOneToMany('brands',Brand::class,'product');
