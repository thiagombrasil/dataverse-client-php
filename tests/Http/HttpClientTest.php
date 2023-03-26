<?php

namespace PHPDataverseClient\Tests\Http;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPDataverseClient\Http\HttpClient;
use PHPUnit\Framework\TestCase;

class HttpClientTest extends TestCase
{
    public function testSuccessfulRequest(): void
    {
        $body = '{"foo":"bar"}';
        $resp = new Response(200, ['Content-Type' => 'application/json'], $body);
        $mock = new MockHandler([$resp]);
        $httpClient = new HttpClient(['handler' => $mock]);
        $respBody = $httpClient->request('POST', '/');

        self::assertEquals($body, $respBody);
    }

    public function testFailRequestWithResponse(): void
    {
        $req = new Request('GET', '/');
        $resp = new Response(400, [], '{"foo":"bar"}');
        $reqException = new RequestException('foo', $req, $resp);
        $mock = new MockHandler([$reqException]);
        $httpClient = new HttpClient(['handler' => $mock]);
        $respBody = $httpClient->request('GET', '/');

        self::assertEquals('{"foo":"bar"} (400 Bad Request)', $respBody);
    }

    public function testFailRequestWithoutResponse(): void
    {
        $req = new Request('GET', '/');
        $reqException = new RequestException('Error completing request', $req);
        $mock = new MockHandler([$reqException]);
        $httpClient = new HttpClient(['handler' => $mock]);
        $respBody = $httpClient->request('GET', '/');

        self::assertEquals('Error completing request', $respBody);
    }
}
