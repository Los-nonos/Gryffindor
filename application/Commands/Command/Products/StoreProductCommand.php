<?php


namespace Application\Commands\Command\Products;


use Infrastructure\CommandBus\Command\CommandInterface;

class StoreProductCommand implements CommandInterface
{
    private string $name;
    private string $description;
    private float $price;
    private array $categories;
    private int $stock;
    private array $characteristics;
    private array $orders;
    private array $provider;


    public function __construct
    (
        //TODO Finish StoreProductCommand
    )
    {
    }

}
