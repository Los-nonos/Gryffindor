<?php


namespace Application\Commands\Handler\Payments;


use App\Exceptions\InvalidBodyException;
use Application\Commands\Command\Payments\MercadoPagoExecuteCommand;
use Application\Exceptions\CalculatedAmountInvalid;
use Application\Services\Customers\CustomerServiceInterface;
use Domain\Entities\Order;
use Domain\Interfaces\Services\Orders\OrderServiceInterface;
use Domain\Interfaces\Services\Payments\PaymentServiceInterface;
use Domain\Interfaces\Services\Products\ProductServiceInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Infrastructure\CommandBus\Command\CommandInterface;
use Infrastructure\CommandBus\Handler\HandlerInterface;
use Money\Money;

class MercadoPagoExecuteHandler implements HandlerInterface
{
    private PaymentServiceInterface $paymentService;

    private CustomerServiceInterface $customerService;

    private ProductServiceInterface $productService;

    private OrderServiceInterface $orderService;

    public function __construct(
        PaymentServiceInterface $paymentService,
        CustomerServiceInterface $customerService,
        ProductServiceInterface $productService,
        OrderServiceInterface $orderService
    )
    {
        $this->paymentService = $paymentService;
        $this->customerService = $customerService;
        $this->productService = $productService;
        $this->orderService = $orderService;
    }

    /**
     * @param MercadoPagoExecuteCommand $command
     * @throws CalculatedAmountInvalid
     */
    public function handle($command): void
    {
        $this->paymentService->createClient();

        $username = env('API_USERNAME');
        $password = env('API_PASSWORD');

        $this->paymentService->login($username, $password);

        $customer = $this->customerService->findOneByIdOrFail($command->getCustomerId());

        $products = $command->getProducts();

        $calculatedAmount = Money::ARS(0);

        foreach ($products as $product) {
            $amount = Money::ARS($product['price']);
            $calculatedAmount = $calculatedAmount->add($amount);
        }

        //TODO: add payment object and set info

        if($calculatedAmount->equals($command->getAmount())) {
            $this->paymentService->mercadoPagoPaymentExecute(null);
        }
        else {
            throw new CalculatedAmountInvalid();
        }


        $products = $this->modifyProductsStock($products);

        $order = new Order();
        $order->setCustomer($customer);
        $order->setAmount($calculatedAmount);
        $order->setProducts($products);

        $this->orderService->persist($order);
    }

    private function modifyProductsStock($products) {
        $productList = [];

        foreach ($products as $product) {
            $productObject = $this->productService->findOneByIdOrFail($product['id']);
            $stock = $productObject->getStock();

            $quantity = $stock->getQuantity();
            $stock->setQuantity($quantity - $product['quantity']);

            array_push($productList, $productObject);

            $this->productService->persist($productObject);
        }

        return $productList;
    }
}
