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
use Domain\ValueObjects\Payment;
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

        $products = $this->productService->modifyProductsStock($products);

        if($calculatedAmount->equals($command->getAmount())) {
            $payment = new Payment($calculatedAmount->getAmount(), $customer->getEmail(), $command->getCartToken(), $command->getPaymentMethod());

            $this->paymentService->mercadoPagoPaymentExecute($payment);
        }
        else {
            throw new CalculatedAmountInvalid();
        }

        $order = new Order();
        $order->setCustomer($customer);
        $order->setAmount($calculatedAmount);
        $order->setProducts($products);

        $this->orderService->persist($order);
    }
}
