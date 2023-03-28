<?php

namespace PHPDataverseClient\Tests\ResponsesEntities;

use PHPDataverseClient\ResponseEntities\DataverseCollectionContact;
use PHPUnit\Framework\TestCase;

final class DataverseCollectionContactTest extends TestCase
{
    public function testConstructorSetsProperties(): void
    {
        $data = [
            'displayOrder' => 0,
            'contactEmail' => 'contact@example.com'
        ];

        $contact = new DataverseCollectionContact($data);

        self::assertEquals($data['displayOrder'], $contact->getDisplayOrder());
        self::assertEquals($data['contactEmail'], $contact->getContactEmail());
    }
}
