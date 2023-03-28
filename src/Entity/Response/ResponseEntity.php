<?php

namespace PHPDataverseClient\Entity\Response;

use InvalidArgumentException;

abstract class ResponseEntity
{
    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            if (! property_exists($this, $key)) {
                throw new InvalidArgumentException(sprintf('Property "%s" does not exist.', $key));
            }
            $listProperties = $this->getListProperties();
            if (key_exists($key, $listProperties)) {
                $this->$key = array_map(static function ($data) use ($listProperties, $key) {
                    return new $listProperties[$key]($data);
                }, $value);
            }
        }
    }

    protected function getListProperties(): array
    {
        return [];
    }
}
