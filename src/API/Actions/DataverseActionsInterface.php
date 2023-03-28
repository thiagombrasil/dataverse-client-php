<?php

namespace PHPDataverseClient\API\Actions;

use PHPDataverseClient\Entity\Request\DataverseRequest;
use PHPDataverseClient\Entity\Response\DataverseResponse;

interface DataverseActionsInterface
{
    public function createDataverse(DataverseRequest $dataverseRequest, string $parent = null): DataverseResponse;
}
