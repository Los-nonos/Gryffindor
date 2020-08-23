<?php


namespace Application\Queries\Handler\Payments;


use Application\Commands\Command\Payments\AfipGenerateCAECommand;
use Application\Queries\Query\Payments\AfipElectronicBillingQuery;
use Application\Queries\Results\Payments\AfipElectronicBillingResult;
use Application\Services\Customers\CustomerServiceInterface;
use Application\Services\Payments\AfipService;
use Domain\Entities\Order;
use Domain\Entities\Product;
use Domain\Interfaces\Services\Orders\OrderServiceInterface;
use Domain\Interfaces\Services\Products\ProductServiceInterface;
use Infrastructure\QueryBus\Handler\HandlerInterface;
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
    /**
     * @var AfipService
     */
    private AfipService $afipService;
    /**
     * @var OrderServiceInterface
     */
    private OrderServiceInterface $orderService;

    public function __construct(
        CustomerServiceInterface $customerService,
        ProductServiceInterface $productService,
        OrderServiceInterface $orderService,
        AfipService $afipService
    ) {
        $this->customerService = $customerService;
        $this->productService = $productService;
        $this->afipService = $afipService;
        $this->orderService = $orderService;
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
            $query->getTypeVoucher(),
            'dni',
            $customer->getDni(),
            $this->getNetAmountTaxed($products),
            $this->getTotalAmountNotTaxed($products),
            $this->getTotalTaxIva($products),
            Money::ARS(''),
            $this->getTotalNetAmountNotTaxed($products),
        );

        $command->setConcept(config('afip.concept'));
        $command->setPointOfSale(config('afip.pointOfSale'));

        $result = $this->afipService->generateCAE($command);

        $this->markSoldProducts($query->getProducts());

        $order = new Order();
        $order->setNumberSell($result['CAE']);
        // TODO: falta guardar la fecha de vencimiento del cae
        $order->setProducts($products);
        $order->setCustomer($customer);

        $this->orderService->persist($order);

        return new AfipElectronicBillingResult($order, $result);
    }

    /**
     * @param int[] $getProducts
     * @return Product[] $products
     */
    private function searchProducts($getProducts)
    {
        $productList = [];
        foreach ($getProducts as $product) {
            array_push($productList, $this->productService->findOneByIdOrFail($product['id']));
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
            $totalMoney->add($product->getPrice(), $product->getTaxes());
        }

        return $totalMoney;
    }

    /**
     * @param Product[] $products
     * @return Money
     */
    private function getNetAmountTaxed($products)
    {
        $totalMoney = Money::ARS(0);

        foreach ($products as $product) {
            if (!$product->getTaxes()->isZero()){
                $totalMoney->add($product->getPrice());
            }
        }

        return $totalMoney;
    }

    /**
     * @param Product[] $products
     * @return Money
     */
    private function getTotalTaxIva($products) {
        $totalMoney = Money::ARS(0);

        foreach ($products as $product) {
            if (!$product->getTaxes()->isZero()){
                $totalMoney->add($product->getTaxes());
            }
        }

        return $totalMoney;
    }

    /**
     * @param Product[] $products
     * @return Money
     */
    private function getTotalAmountNotTaxed(array $products)
    {
        $totalMoney = Money::ARS(0);

        foreach ($products as $product) {
            if ($product->getTaxes()->isZero()){
                $totalMoney->add($product->getPrice());
            }
        }

        return $totalMoney;
    }

    private function getTotalNetAmountNotTaxed(array $products)
    {
        $totalMoney = Money::ARS(0);

        foreach ($products as $product) {
            if ($product->getTaxes()->isZero()){
                $totalMoney->add($product->getTaxes());
            }
        }

        return $totalMoney;
    }

    /**
     * @param array $products
     */
    private function markSoldProducts(array $products)
    {
        $this->productService->modifyProductsStock($products);
    }
}
