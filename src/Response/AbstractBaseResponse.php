<?php

declare(strict_types=1);

namespace App\Response;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractBaseResponse
{
    abstract public function response(): JsonResponse|Response;
}