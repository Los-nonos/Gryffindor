<?php


namespace Application\Commands\Handler\Payments;


use App\Exceptions\InvalidBodyException;
use Application\Commands\Command\Payments\MercadoPagoExecuteCommand;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Infrastructure\CommandBus\Command\CommandInterface;
use Infrastructure\CommandBus\Handler\HandlerInterface;

class MercadoPagoExecuteHandler implements HandlerInterface
{

    public function __construct()
    {

    }

    /**
     * @param MercadoPagoExecuteCommand $command
     * @throws GuzzleException
     */
    public function handle($command): void
    {
        $baseUrl = env('BASE_URL');

        $client = new Client(['base_uri' => $baseUrl]);

        $response = $client->request('POST', '/payments/mercadopago');
        if($response->getStatusCode() == 400 || $response->getStatusCode() == 500) {
            throw new InvalidBodyException($response->getBody());
        }

        $data = json_decode($response->getBody());
    }
}
