<?php

namespace App\Service;

use GuzzleHttp\Client as GuzzleClient;

class PaypalClient
{
    private $client;
    private $accessToken;
    public function __construct()
    {
        if (config('paypal.setting.mode') === 'live') {
            $clientId = config('paypal.live_client_id');
            $clientSecret = config('paypal.live_secret');
            $baseUri = 'https://api-m.paypal.com';
        } else {
            $clientId = config('paypal.sandbox_client_id');
            $clientSecret = config('paypal.sandbox_secret');
            $baseUri = 'https://api-m.sandbox.paypal.com';
        }
        $this->client = new GuzzleClient(['base_uri' => $baseUri]);
        $this->accessToken = $this->getAccessToken($clientId, $clientSecret);
    }
    private function getAccessToken($clientId, $clientSecret)
    {
        $response = $this->client->request('POST', '/v1/oauth2/token', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'body' => 'grant_type=client_credentials',
            'auth' => [$clientId, $clientSecret, 'basic'],
        ]);
        $data = json_decode($response->getBody(), true);
        return $data['access_token'];
    }
    private function getHeaders()
    {
        return [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->accessToken,
            'Content-Type' => 'application/json',
        ];
    }
    public function createProduct($body)
    {
        $response = $this->client->request('POST', '/v1/catalogs/products', [
            'json' => $body,
            'headers' => $this->getHeaders(),
        ]);
        return json_decode($response->getBody(), true);
    }
    public function getAllProducts()
    {
        $response = $this->client->request('GET', '/v1/catalogs/products', [
            'headers' => $this->getHeaders(),
        ]);
        return json_decode($response->getBody(), true);
    }
    public function createPlan($body)
    {
        $response = $this->client->request('POST', '/v1/billing/plans', [
            'json' => $body,
            'headers' => $this->getHeaders(),
        ]);
        return json_decode($response->getBody(), true);
    }

    public function getAllPlans()
    {
        $response = $this->client->request('GET', '/v1/billing/plans', [
            'headers' => $this->getHeaders(),
        ]);
        return json_decode($response->getBody(), true);
    }
}
