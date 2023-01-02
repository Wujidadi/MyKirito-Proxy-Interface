<?php

namespace App\Services;

use App\Constants\MyKirito\Api as MyKiritoApi;
use App\Utilities\Client\ClientFactory;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\TooManyRedirectsException;
use GuzzleHttp\RequestOptions as HttpRequestOptions;

class MyKiritoApiClient
{
    private int $timeout = 0;
    private int $connectTimeout = 0;

    private string $baseUrl;
    private HttpClient $client;

    public function __construct()
    {
        $this->baseUrl = MyKiritoApi::API_BASE;
        $this->client = ClientFactory::create('mykirito');
    }

    public function request(array $params): \stdClass
    {
        $result = (object) [
            'statusCode' => 200,
            'headers' => [],
            'body' => '',
        ];

        try {
            $method = $params['method'] ?? 'GET';
            $uri = $params['uri'];
            if (!preg_match('/^http/', $params['uri'])) {
                $uri = $this->baseUrl . $params['uri'];
            }
            $options = array_merge($params['options'] ?? [], [
                HttpRequestOptions::HEADERS => $params['headers'] ?? [],
                HttpRequestOptions::TIMEOUT => $this->timeout,
                HttpRequestOptions::CONNECT_TIMEOUT => $this->connectTimeout,
                HttpRequestOptions::SYNCHRONOUS => isset($params['isAsyncRequest']) ? (!$params['isAsyncRequest']) : false,
                HttpRequestOptions::HTTP_ERRORS => false,
            ]);

            $response = $this->client->request($method, $uri, $options);

            $result->statusCode = $response->getStatusCode();
            $result->headers = $response->getHeaders();
            $responseBody = $response->getBody()->getContents();
            if ($responseArray = json_decode($responseBody, true)) {
                $result->body = $responseArray;
            } else {
                $result->body = $responseBody;
            }
        } catch (ConnectException $e) {
            $result->statusCode = 599;
            $result->body = 'Connection error';
        } catch (TooManyRedirectsException $e) {
            $result->statusCode = 399;
            $result->body = 'Too many redirects';
        }

        return $result;
    }

    public function getTimeout(): int
    {
        return $this->timeout;
    }

    public function setTimeout($timeout): static
    {
        $this->timeout = $timeout;
        return $this;
    }

    public function getConnectTimeout(): int
    {
        return $this->connectTimeout;
    }

    public function setConnectTimeout($connectTimeout): static
    {
        $this->connectTimeout = $connectTimeout;
        return $this;
    }
}
