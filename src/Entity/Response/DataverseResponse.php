<?php

namespace PHPDataverseClient\Entity\Response;

use PHPDataverseClient\Entity\DataverseContact;

class DataverseResponse extends ResponseEntity
{
    protected $id;

    protected $alias;

    protected $name;

    protected $affiliation;

    protected $dataverseContacts;

    protected $permissionRoot;

    protected $description;

    protected $dataverseType;

    protected $ownerId;

    protected $creationDate;

    protected function getListProperties(): array
    {
        return [
            'dataverseContacts' => DataverseContact::class
        ];
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
