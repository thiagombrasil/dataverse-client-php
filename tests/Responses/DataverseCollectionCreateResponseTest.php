<?php

namespace PHPDataverseClient\Tests\Entities;

use PHPDataverseClient\Responses\DataverseCollectionCreateResponse;
use PHPUnit\Framework\TestCase;

final class DataverseCollectionCreateResponseTest extends TestCase
{
    public function testConstructorSetsProperties()
    {
        $data = [
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
        ];

        $collectionCreateResp = new DataverseCollectionCreateResponse($data);

        self::assertEquals($data['id'], $collectionCreateResp->getId());
        self::assertEquals($data['alias'], $collectionCreateResp->getAlias());
        self::assertEquals($data['name'], $collectionCreateResp->getName());
        self::assertEquals($data['affiliation'], $collectionCreateResp->getAffiliation());
        self::assertEquals($data['permissionRoot'], $collectionCreateResp->getPermissionRoot());
        self::assertEquals($data['description'], $collectionCreateResp->getDescription());
        self::assertEquals($data['dataverseType'], $collectionCreateResp->getDataverseType());
        self::assertEquals($data['ownerId'], $collectionCreateResp->getOwnerId());
        self::assertEquals($data['creationDate'], $collectionCreateResp->getCreationDate());
        self::assertEquals(
            $data['dataverseContacts'][0]['displayOrder'],
            $collectionCreateResp->getDataverseContacts()[0]->getDisplayOrder()
        );
        self::assertEquals(
            $data['dataverseContacts'][0]['contactEmail'],
            $collectionCreateResp->getDataverseContacts()[0]->getContactEmail()
        );
    }
}
