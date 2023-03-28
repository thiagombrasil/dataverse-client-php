<?php

namespace PHPDataverseClient\Entity;

class DataverseContact
{
    private $displayOrder;

    private $contactEmail;

    public function __construct(array $data)
    {
        $this->displayOrder = $data['displayOrder'] ?? null;
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
