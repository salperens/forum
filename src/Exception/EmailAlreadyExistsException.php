<?php

declare(strict_types=1);

namespace App\Exception;

use Exception;

final class EmailAlreadyExistsException extends Exception
{
    public static function make(string $email): self
    {
        return new self(sprintf('The email "%s" is already in use.', $email));
    }
}