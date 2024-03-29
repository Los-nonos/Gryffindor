<?php

use Doctrine\DBAL\Types\Types as Type;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Domain\Entities\Customer;
use Domain\Entities\Employee;
use Domain\Entities\Product;
use Domain\Entities\User;

$builder = new ClassMetadataBuilder($metadata);
$builder->setTable('orders');
$builder->createField('id', Type::INTEGER)
    ->makePrimaryKey()
    ->generatedValue()
    ->build();

$builder->addField('amount', Type::INTEGER);

$builder->addField('numberSell', Type::STRING);

$builder->addInverseManyToMany('products', Product::class, 'orders');

$builder->addManyToOne('customer', Customer::class,'orders');

$builder->addManyToOne('employee', Employee::class, 'orders');
