<?php

namespace PHPDataverseClient\Tests\Http;

use PHPDataverseClient\Entity\Request\DataverseRequest;
use PHPDataverseClient\Entity\Response\DataverseResponse;
use PHPDataverseClient\Http\HttpResponse;
use PHPUnit\Framework\TestCase;

class HttpResponseTest extends TestCase
{
    public function testSetAllProperties(): void
    {
        $response = new HttpResponse(200, 'OK', '{"foo":"bar"}');

        self::assertEquals(200, $response->getStatusCode());
        self::assertEquals('OK', $response->getMessage());
        self::assertEquals('{"foo":"bar"}', $response->getBody());
    }

    public function testSetPropertiesWithoutBody(): void
    {
        $response = new HttpResponse(200, 'OK');

        self::assertEquals(200, $response->getStatusCode());
        self::assertEquals('OK', $response->getMessage());
        self::assertNull($response->getBody());
    }

    public function testGetBodyAsArray(): void
    {
        $response = new HttpResponse(200, 'OK', '{"foo":"bar"}');

        self::assertEquals(['foo' => 'bar'], $response->getBodyAsArray());
    }

    public function testGetBodyAsResponseEntity(): void
    {
        $body = json_encode([
            'id' => 2020,
            'alias' => 'testCollection',
            'name' => 'Test Collection',
            'affiliation' => 'Dataverse',
            'dataverseContacts' => [
                [
                    'displayOrder' => 0,
                    'contactEmail' => 'test@example.com'
                ]
            ],
            'permissionRoot' => true,
            'description' => 'A test Dataverse Collection.',
            'dataverseType' => 'UNCATEGORIZED',
            'ownerId' => 1,
            'creationDate' => '2000-01-01T12:00:00Z'
        ]);

        $response = new HttpResponse(200, 'OK', $body);

        self::assertInstanceOf(DataverseResponse::class, $response->getBodyAsResponseEntity(DataverseResponse::class));
    }

    public function testExceptionOnInvalidResponseEntityClass(): void
    {
        $response = new HttpResponse(200, 'OK', '{"foo":"bar"}');

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The given class must extend ResponseEntity');
        $response->getBodyAsResponseEntity(DataverseRequest::class);
    }

    public function testResponseEntityWithEmptyBody(): void
    {
        $response = new HttpResponse(200, 'OK', '{}');

        self::assertNull($response->getBodyAsResponseEntity(DataverseResponse::class));
    }
}
