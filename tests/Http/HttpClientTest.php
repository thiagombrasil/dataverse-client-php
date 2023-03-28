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

    public function testRequestCatchGuzzleException(): void
    {
        $e = RequestException::create(new Request('GET', '/'));
        $mock = new MockHandler([$e]);
        $httpClient = new HttpClient(['handler' => $mock]);
        $respBody = $httpClient->request('GET', '/');

        self::assertEquals('Error completing request', $respBody);
    }

    public function testRequestCatchBadResponseExceptionException(): void
    {
        $req = new Request('GET', '/');
        $resp = new Response(400, [], '{"foo":"bar"}');
        $e = RequestException::create($req, $resp);
        $mock = new MockHandler([$e]);
        $httpClient = new HttpClient(['handler' => $mock]);
        $respBody = $httpClient->request('GET', '/');

        self::assertEquals('{"foo":"bar"}', $respBody);
    }
}
