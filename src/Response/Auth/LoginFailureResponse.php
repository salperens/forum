<?php

declare(strict_types=1);

namespace App\Response\Auth;

use App\Response\AbstractBaseResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class LoginFailureResponse extends AbstractBaseResponse
{

    public function __construct(
        private readonly string $message,
    )
    {
    }

    public function response(): JsonResponse|Response
    {
        return new JsonResponse(
            data: [
                'message' => $this->message,
            ],
            status: Response::HTTP_UNAUTHORIZED,
        );
    }
}