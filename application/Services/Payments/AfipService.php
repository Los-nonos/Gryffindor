<?php


namespace Application\Services\Payments;


use Application\Commands\Command\Payments\AfipGenerateCAECommand;

class AfipService
{
    /**
     * @var PaymentService
     */
    private PaymentService $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
        $username = env('API_USERNAME');
        $password = env('API_PASSWORD');
        $this->paymentService->createClient();
        $this->paymentService->login($username, $password);
    }

    public function generateCAE(AfipGenerateCAECommand $command)
    {
        $body = [
            'totalAmount' => $command->getTotalMoney()->getAmount(),
            'voucherQuantity' => $command->getVoucherQuantity(),
            'pointOfSale' => $command->getPointOfSale(),
            'typeVoucher' => $command->getTypeVoucher(),
            'purchaserTypeDocument' => $command->getPurchaserTypeDocument(),
            'purchaserNumberDocument' => $command->getPurchaserNumberDocument(),
            'concept' => $command->getConcept(),
            'taxNet' => $command->getTaxNet()->getAmount(),
            'taxExempt' => $command->getTaxExempt()->getAmount(),
            'totalIva' => $command->getTotalIva()->getAmount(),
            'totalTributes' => $command->getTotalTributes()->getAmount(),
            'amountNotTaxed' => $command->getAmountNotTaxed()->getAmount(),
            'initDate' => $command->getInitDate(),
            'endDate' => $command->getEndDate(),
            'expirationDate' => $command->getExpirationDate(),
        ];

        $this->paymentService->executeRequest('POST', 'payments/afip/electronicbilling', $body);
    }
}
