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
        $httpResp = $httpClient->request('POST', '/');

        self::assertEquals(200, $httpResp->getStatusCode());
        self::assertEquals('OK', $httpResp->getMessage());
        self::assertEquals($body, $httpResp->getBody());
    }

    public function testRequestCatchGuzzleException(): void
    {
        $e = RequestException::create(new Request('GET', '/'));
        $mock = new MockHandler([$e]);
        $httpClient = new HttpClient(['handler' => $mock]);
        $httpResp = $httpClient->request('GET', '/');

        self::assertEquals('Error completing request', $httpResp->getMessage());
    }

    public function testRequestCatchBadResponseExceptionException(): void
    {
        $req = new Request('GET', '/');
        $resp = new Response(400, [], '{"foo":"bar"}');
        $e = RequestException::create($req, $resp);
        $mock = new MockHandler([$e]);
        $httpClient = new HttpClient(['handler' => $mock]);
        $httpResp = $httpClient->request('GET', '/');

        self::assertEquals('{"foo":"bar"}', $httpResp->getBody());
    }
}
