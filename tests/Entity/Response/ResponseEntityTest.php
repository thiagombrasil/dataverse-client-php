<?php

namespace PHPDataverseClient\Tests\Entity\Response;

use PHPDataverseClient\Entity\DataverseContact;
use PHPDataverseClient\Entity\Response\ResponseEntity;
use PHPUnit\Framework\TestCase;

class ResponseEntityTest extends TestCase
{
    public function testExceptionOnInvalidPropertyData(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Property "name" does not exist.');

        $responseEntity = new class (['name' => 'test']) extends ResponseEntity {
        };
    }

    public function testSetProperty(): void
    {
        $data = ['name' => 'test'];
        $responseEntity = new class ($data) extends ResponseEntity {
            protected $name;

            public function getName(): string
            {
                return $this->name;
            }
        };

        self::assertEquals($data['name'], $responseEntity->getName());
    }

    public function testCreateListProperties(): void
    {
        $data = [
            'dataverseContacts' => [
                [
                    'contactEmail' => 'test@example.com'
                ]
            ]
        ];

        $responseEntity = new class ($data) extends ResponseEntity {
            protected $dataverseContacts;

            public function getDataverseContacts(): array
            {
                return $this->dataverseContacts;
            }

            protected function getListProperties(): array
            {
                return [
                    'dataverseContacts' => DataverseContact::class
                ];
            }
        };

        self::assertContainsOnlyInstancesOf(DataverseContact::class, $responseEntity->getDataverseContacts());
    }
}
