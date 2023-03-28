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

    public function request(string $method, string $uri, array $options = []): string
    {
        try {
            $response = $this->client->request($method, $uri, $options);
        } catch (BadResponseException $e) {
            return (string) $e->getResponse()->getBody();
        } catch (GuzzleException $e) {
            return $e->getMessage();
        }
        return (string) $response->getBody();
    }
}
