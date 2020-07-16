<?php

use Doctrine\DBAL\Types\Types as Type;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Domain\Entities\Product;
use Domain\Entities\PurchaseOrder;

$builder = new ClassMetadataBuilder($metadata);
$builder->setTable('providers');
$builder->createField('id', Type::INTEGER)
    ->makePrimaryKey()
    ->generatedValue()
    ->build();

$builder->addField('name', Type::STRING);

$builder->addField('busisnessName', Type::STRING);

$builder->addField('phoneNumber', Type::STRING);

$builder->addField('zipCode', Type::STRING);

$builder->addField('address', Type::STRING);

$builder->addField('observations', Type::STRING);

$builder->createManyToMany('products', Product::class)
    ->inversedBy('providers')
    ->build();

$builder->createOneToMany('orders', PurchaseOrder::class)
    ->mappedBy('provider')
    ->build();

