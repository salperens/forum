<?php

declare(strict_types=1);

namespace App\Helper;

use Symfony\Component\HttpFoundation\Request;

class RequestHelper
{
    public static function getBodyAsArray(Request $request): ?array
    {
        return json_decode($request->getContent(), true);
    }

    public static function getBodyAsObject(Request $request): ?object
    {
        return json_decode($request->getContent());
    }
}