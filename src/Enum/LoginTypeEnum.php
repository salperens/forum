<?php

declare(strict_types=1);

namespace App\Enum;

enum LoginTypeEnum: string
{
    case EMAIL = 'email';

    case GOOGLE = 'google';

    case APPLE = 'apple';
}
