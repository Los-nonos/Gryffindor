<?php

declare(strict_types=1);

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Persistence\Doctrine\CurrentTimestampBuilder;

$builder = new ClassMetadataBuilder($metadata);
$builder->setTable('courses');
$builder->createField('id', Type::INTEGER)
    ->makePrimaryKey()
    ->generatedValue()
    ->build();

$builder->addField('name', Type::STRING);

$builder->addField('description', Type::STRING);

$builder->addField('available', Type::BOOLEAN);

$builder->createManyToMany('teachers', \Domain\Entities\Teacher::class)
    ->cascadePersist()
    ->build();

$builder->createManyToMany('categories', \Domain\Entities\Category::class)
    ->cascadePersist()
    ->build();

$builder->createManyToMany('tags', \Domain\Entities\Tag::class)
    ->cascadePersist()
    ->build();
