<?php

namespace PHPDataverseClient\Responses;

class DataverseCollectionContact
{
    private $displayOrder;

    private $contactEmail;

    public function __construct(array $data)
    {
        $this->displayOrder = $data['displayOrder'];
        $this->contactEmail = $data['contactEmail'];
    }

    public function getDisplayOrder(): int
    {
        return $this->displayOrder;
    }

    public function getContactEmail(): string
    {
        return $this->contactEmail;
    }
}
