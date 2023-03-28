<?php

namespace PHPDataverseClient\Tests\Entity;

use PHPDataverseClient\Entity\DataverseContact;
use PHPUnit\Framework\TestCase;

final class DataverseContactTest extends TestCase
{
    public function testConstructorSetsProperties(): void
    {
        $data = [
            'displayOrder' => 0,
            'contactEmail' => 'contact@example.com'
        ];

        $contact = new DataverseContact($data);

        self::assertEquals($data['displayOrder'], $contact->getDisplayOrder());
        self::assertEquals($data['contactEmail'], $contact->getContactEmail());
    }
}
