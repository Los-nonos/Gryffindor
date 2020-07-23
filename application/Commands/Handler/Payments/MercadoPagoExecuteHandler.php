<?php


namespace Application\Commands\Handler\Payments;


use App\Exceptions\InvalidBodyException;
use Application\Commands\Command\Payments\MercadoPagoExecuteCommand;
use Application\Services\Customers\CustomerServiceInterface;
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

    public function __construct(
        PaymentServiceInterface $paymentService,
        CustomerServiceInterface $customerService,
        ProductServiceInterface $productService
    )
    {
        $this->paymentService = $paymentService;
        $this->customerService = $customerService;
        $this->productService = $productService;
    }

    /**
     * @param MercadoPagoExecuteCommand $command
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
            $calculatedAmount->add($amount);
        }

        //TODO: add payment object and set info

        if($calculatedAmount === $command->getAmount()) {
            $this->paymentService->mercadoPagoPaymentExecute(null);
        }

        //TODO: check products, modify stocks and create order

        $this->modifyProductsStock($products);
    }

    private function modifyProductsStock($products) {
        foreach ($products as $product) {
            $productObject = $this->productService->findOneByIdOrFail($product['id']);
            $stock = $productObject->getStock();

            $quantity = $stock->getQuantity();
            $stock->setQuantity($quantity - $product['quantity']);

            $this->productService->persist($productObject);
        }
    }
}
