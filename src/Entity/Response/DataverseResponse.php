<?php

namespace PHPDataverseClient\Entity\Response;

use PHPDataverseClient\Entity\DataverseContact;

class DataverseResponse
{
    public $id;

    public $alias;

    public $name;

    public $affiliation;

    public $dataverseContacts;

    public $permissionRoot;

    public $description;

    public $dataverseType;

    public $ownerId;

    public $creationDate;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->alias = $data['alias'];
        $this->name = $data['name'];
        $this->affiliation = $data['affiliation'];
        $this->permissionRoot = $data['permissionRoot'];
        $this->description = $data['description'];
        $this->dataverseType = $data['dataverseType'];
        $this->ownerId = $data['ownerId'];
        $this->creationDate = $data['creationDate'];

        $this->dataverseContacts = array_map(static function ($contact) {
            return new DataverseContact($contact);
        }, $data['dataverseContacts']);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAlias(): string
    {
        return $this->alias;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAffiliation(): string
    {
        return $this->affiliation;
    }

    public function getDataverseContacts(): array
    {
        return $this->dataverseContacts;
    }

    public function getPermissionRoot(): bool
    {
        return $this->permissionRoot;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getDataverseType(): string
    {
        return $this->dataverseType;
    }

    public function getOwnerId(): int
    {
        return $this->ownerId;
    }

    public function getCreationDate(): string
    {
        return $this->creationDate;
    }
}
