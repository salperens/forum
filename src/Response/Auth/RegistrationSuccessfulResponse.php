<?php

declare(strict_types=1);

namespace App\Response\Auth;

use App\Response\AbstractBaseResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class RegistrationSuccessfulResponse extends AbstractBaseResponse
{

    public function __construct(
        private readonly string $token,
        private readonly string $message = 'Registration successful',
    )
    {
    }

    public function response(): JsonResponse|Response
    {
        return new JsonResponse(
            data: [
                'message' => $this->message,
                'data' => [
                    'token' => $this->token,
                ],
            ],
            status: Response::HTTP_CREATED
        );
    }
}