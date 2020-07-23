<?php

namespace Application\Services\Payments;

use App\Exceptions\InvalidBodyException;
use Application\Exceptions\ClientNotInitialized;
use Application\Exceptions\ClientNotLogged;
use Domain\Interfaces\Services\Payments\PaymentServiceInterface;
use Domain\ValueObjects\Payment;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class PaymentService implements PaymentServiceInterface
{
    private $client;
    private $userData;
    private $token;

    public function __construct()
    {
        $this->client = null;
        $this->userData = null;
        $this->token = null;
    }


    public function createClient(): void {
        $baseUrl = env('BASE_URL');

        $this->client = new Client(['base_uri' => $baseUrl]);
    }

    public function login(string $username, string $password): void
    {
        if($this->client == null) {
            throw new ClientNotInitialized();
        }

        $base_url = env('BASE_URL');
        $base_url = $base_url . '/auth/login';

        $body = [
            'username' => $username,
            'password' => $password,
        ];

        $request = new Request('POST', $base_url, [], $body);

        $response = $this->client->send($request);

        if($response->getStatusCode() >= 400 && $response->getStatusCode() <= 599) {
            throw new InvalidBodyException($response->getBody());
        }

        $this->userData = json_decode($response->getBody());
        $this->token = $this->userData['token'];
    }

    public function mercadoPagoPaymentExecute(Payment $data) {
        if($this->client == null) {
            throw new ClientNotInitialized();
        }

        if($this->token == null) {
            throw new ClientNotLogged();
        }

        $base_url = env('BASE_URL');
        $base_url = $base_url . '/auth/login';

        $body = [
            'access_token' => env('API_ACCESS_TOKEN'),
            'amount' => $data->getAmount(),
            'email_payer' => $data->getEmailPayer(),
            'cart_token' => $data->getCartToken(),
            'payment_method' => $data->getPaymentMethod(),
            'customer_id' => $this->userData['id'],
        ];

        $request = new Request('POST', $base_url, [ 'authorization' => $this->token ], $body);

        $response = $this->client->send($request);

        if($response->getStatusCode() >= 400 && $response->getStatusCode() <= 599) {
            throw new InvalidBodyException($response->getBody());
        }

        return json_decode($response->getBody());
    }
}
