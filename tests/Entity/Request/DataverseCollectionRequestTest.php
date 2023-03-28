<?php

namespace PHPDataverseClient\Tests\Entity\Request;

use PHPDataverseClient\Entity\DataverseContact;
use PHPDataverseClient\Entity\Request\DataverseCollectionRequest;
use PHPUnit\Framework\TestCase;

class DataverseCollectionRequestTest extends TestCase
{
    public function testSetRequiredProperties(): void
    {
        $data = [
            'name' => 'Test Dataverse',
            'alias' => 'testDataverse',
            'dataverseContacts' => [
                [
                    'contactEmail' => 'test@email.com'
                ]
            ]
        ];
        $collectionRequest = new DataverseCollectionRequest($data);

        self::assertEquals($data['name'], $collectionRequest->getName());
        self::assertEquals($data['alias'], $collectionRequest->getAlias());
        self::assertContainsOnlyInstancesOf(
            DataverseContact::class,
            $collectionRequest->getDataverseContacts()
        );
    }

    public function testSetCompleteProperties(): void
    {
        $data = [
            'name' => 'Test Dataverse',
            'alias' => 'testDataverse',
            'dataverseContacts' => [
                [
                    'contactEmail' => 'test@email.com'
                ]
            ],
            'affiliation' => 'Dataverse',
            'description' => 'A Dataverse for tests.',
            'dataverseType' => 'UNCATEGORIZED'
        ];
        $collectionRequest = new DataverseCollectionRequest($data);

        self::assertEquals($data['name'], $collectionRequest->getName());
        self::assertEquals($data['alias'], $collectionRequest->getAlias());
        self::assertEquals($data['affiliation'], $collectionRequest->getAffiliation());
        self::assertEquals($data['description'], $collectionRequest->getDescription());
        self::assertEquals($data['dataverseType'], $collectionRequest->getDataverseType());
        self::assertContainsOnlyInstancesOf(
            DataverseContact::class,
            $collectionRequest->getDataverseContacts()
        );
    }
}
