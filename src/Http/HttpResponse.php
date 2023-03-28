<?php

namespace PHPDataverseClient\Http;

use InvalidArgumentException;
use PHPDataverseClient\Entity\Response\ResponseEntity;

class HttpResponse
{
    private $statusCode;

    private $message;

    private $body;

    public function __construct(int $statusCode, string $message, string $body = null)
    {
        $this->statusCode = $statusCode;
        $this->message = $message;
        $this->body = $body;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function getBodyAsArray(): array
    {
        return json_decode($this->body, true);
    }

    public function getBodyAsResponseEntity(string $responseEntityClass): ?ResponseEntity
    {
        if (!is_subclass_of($responseEntityClass, ResponseEntity::class)) {
            throw new InvalidArgumentException(
                'The given class must extend ResponseEntity.'
            );
        }

        $data = $this->getBodyAsArray();

        if (empty($data)) {
            return null;
        }

        return new $responseEntityClass($data);
    }
}
