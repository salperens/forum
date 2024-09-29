<?php

declare(strict_types=1);

namespace App\Schema;

use ReflectionClass;

abstract class AbstractBaseSchema
{
    public function toArray(): array
    {
        $reflection = new ReflectionClass($this);

        $propertyArray = [];

        foreach ($reflection->getProperties() as $property) {
            $propertyArray[$property->getName()] = $this->{$property->getName()};
        }

        return $propertyArray;
    }
}