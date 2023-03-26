<?php

namespace PHPDataverseClient\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class HttpClient
{
    private $client;

    public function __construct(array $config = [])
    {
        $this->client = new Client($config);
    }

    public function request(string $method, string $url, array $options = []): string
    {
        try {
            $response = $this->client->request($method, $url, $options);
        } catch (RequestException $e) {
            $message = $e->getMessage();
            if ($e->hasResponse()) {
                $exceptionResponse = $e->getResponse();
                $body = $exceptionResponse->getBody(true);
                $statusCode = $exceptionResponse->getStatusCode();
                $reasonPhrase = $exceptionResponse->getReasonPhrase();
                $message = $body . ' (' . $statusCode . ' ' . $reasonPhrase . ')';
            }
            return $message;
        }
        return $response->getBody(true);
    }
}
