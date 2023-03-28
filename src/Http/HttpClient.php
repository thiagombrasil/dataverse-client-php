<?php

namespace PHPDataverseClient\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\GuzzleException;

class HttpClient
{
    private $client;

    public function __construct(array $config = [])
    {
        $this->client = new Client($config);
    }

    public function request(string $method, string $uri, array $options = []): HttpResponse
    {
        try {
            $response = $this->client->request($method, $uri, $options);
        } catch (BadResponseException $e) {
            return new HttpResponse(
                $e->getResponse()->getStatusCode(),
                $e->getResponse()->getReasonPhrase(),
                (string) $e->getResponse()->getBody()
            );
        } catch (GuzzleException $e) {
            return new HttpResponse(
                $e->getCode(),
                $e->getMessage()
            );
        }
        return new HttpResponse(
            $response->getStatusCode(),
            $response->getReasonPhrase(),
            (string) $response->getBody()
        );
    }
}
