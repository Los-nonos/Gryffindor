<?php


namespace Application\Commands\Handler\Orders;


use Application\Commands\Command\Orders\StoreOrderCommand;
use Application\Exceptions\CalculatedAmountInvalid;
use Application\Exceptions\RoleInvalid;
use Application\Services\Customers\CustomerServiceInterface;
use Application\Services\Users\UserServiceInterface;
use Domain\Entities\Order;
use Domain\Interfaces\Services\Orders\OrderServiceInterface;
use Domain\Interfaces\Services\Products\ProductServiceInterface;
use Domain\ValueObjects\Payment;
use Infrastructure\CommandBus\Command\CommandInterface;
use Infrastructure\CommandBus\Handler\HandlerInterface;
use Money\Money;

class StoreOrderHandler implements HandlerInterface
{
    private ProductServiceInterface $productService;

    private CustomerServiceInterface $customerService;

    private UserServiceInterface $userService;

    private OrderServiceInterface $orderService;

    public function __construct(
        ProductServiceInterface $productService,
        CustomerServiceInterface $customerService,
        UserServiceInterface $userService,
        OrderServiceInterface $orderService
    )
    {
        $this->customerService = $customerService;
        $this->productService = $productService;
        $this->userService = $userService;
        $this->orderService = $orderService;
    }

    /**
     * @param StoreOrderCommand $command
     * @throws CalculatedAmountInvalid|RoleInvalid
     */
    public function handle($command): void
    {
        $products = $command->getProducts();

        $calculatedAmount = Money::ARS(0);

        foreach ($products as $product) {
            $productObject = $this->productService->findOneByIdOrFail($product['id']);
            $price = $productObject->getPrice();
            $taxes = $productObject->getTaxes();

            $amount = $price->add($taxes);
            $calculatedAmount = $calculatedAmount->add($amount);
        }

        $products = $this->productService->modifyProductsStock($products);

        if(!$calculatedAmount->equals($command->getAmount())) {
            throw new CalculatedAmountInvalid();
        }

        $customer = $this->customerService->findOneByIdOrFail($command->getCustomerId());
        $employee = $this->userService->findOneByIdOrFail($command->getEmployeeId());

        if(!$employee->isEmployee())
        {
            throw new RoleInvalid();
        }

        $order = new Order();
        $order->setCustomer($customer);
        $order->setAmount($calculatedAmount);
        $order->setProducts($products);
        $order->setEmployee($employee->getEmployee());

        $this->orderService->persist($order);
    }
}
