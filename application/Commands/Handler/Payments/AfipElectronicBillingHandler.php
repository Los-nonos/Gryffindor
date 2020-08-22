<?php


namespace Application\Commands\Handler\Payments;


use Application\Commands\Command\Payments\AfipGenerateCAECommand;
use Application\Services\Customers\CustomerServiceInterface;
use Domain\Entities\Product;
use Domain\Interfaces\Services\Products\ProductServiceInterface;
use Infrastructure\QueryBus\Handler\HandlerInterface;
use Infrastructure\QueryBus\Query\QueryInterface;
use Infrastructure\QueryBus\Result\ResultInterface;
use Money\Money;

class AfipElectronicBillingHandler implements HandlerInterface
{
    /**
     * @var CustomerServiceInterface
     */
    private CustomerServiceInterface $customerService;
    /**
     * @var ProductServiceInterface
     */
    private ProductServiceInterface $productService;

    public function __construct(
        CustomerServiceInterface $customerService,
        ProductServiceInterface $productService
    ) {
        $this->customerService = $customerService;
        $this->productService = $productService;
    }

    /**
     * @param AfipElectronicBillingQuery $query
     * @return ResultInterface
     */
    public function handle($query): ResultInterface
    {
        $customer = $this->customerService->findOneByIdOrFail($query->getCustomerId());

        $products = $this->searchProducts($query->getProducts());

        $command = new AfipGenerateCAECommand(
            $this->getTotalMoney($products),
            1,
            '',
            'dni',
            $customer->getDni(),
            $this->getTaxNet($products),
            Money::ARS(''),
            Money::ARS(''),
            Money::ARS(''),
            Money::ARS('')
        );

    }

    /**
     * @param int[] $getProducts
     * @return Product[] $products
     */
    private function searchProducts($getProducts)
    {
        $productList = [];
        foreach ($getProducts as $product) {
            array_push($productList, $this->productService->findOneByIdOrFail($product));
        }

        return $productList;
    }

    /**
     * @param Product[] $products
     * @return Money
     */
    private function getTotalMoney($products)
    {
        $totalMoney = Money::ARS(0);

        foreach ($products as $product) {
            $totalMoney->add($product->getPrice());
        }

        return $totalMoney;
    }

    /**
     * @param Product[] $products
     * @return Money
     */
    private function getTaxNet($products)
    {
        $totalMoney = Money::ARS(0);

        foreach ($products as $product) {
            $totalMoney->add($product->getTaxes());
        }

        return $totalMoney;
    }

}
