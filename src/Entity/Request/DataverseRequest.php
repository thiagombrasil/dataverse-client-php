<?php

namespace PHPDataverseClient\Entity\Request;

use PHPDataverseClient\Entity\DataverseContact;

class DataverseRequest
{
    private $name;

    private $alias;

    private $dataverseContacts;

    private $affiliation;

    private $description;

    private $dataverseType;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->alias = $data['alias'];
        $this->affiliation = $data['affiliation'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->dataverseType = $data['dataverseType'] ?? null;

        $this->dataverseContacts = array_map(static function ($dataverseContact) {
            return new DataverseContact($dataverseContact);
        }, $data['dataverseContacts']);
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function getAlias(): string
    {
        return $this->alias;
    }

    public function getDataverseContacts(): array
    {
        return $this->dataverseContacts;
    }

    public function getAffiliation(): ?string
    {
        return $this->affiliation;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getDataverseType(): ?string
    {
        return $this->dataverseType;
    }
}
