<?php

declare(strict_types=1);

namespace App\Response\Auth;

use App\Entity\User;
use App\Response\AbstractBaseResponse;
use Symfony\Component\HttpFoundation\{JsonResponse, Response};

final class LoginSuccessfulResponse extends AbstractBaseResponse
{
    public function __construct(
        private readonly User $user,
        private readonly string $token,
    )
    {
    }

    public function response(): JsonResponse
    {
        return new JsonResponse(
            data: [
                'message' => 'Login successfully!',
                'data' => [
                    'username' => $this->user->getUserName(),
                    'token' => $this->token,
                ]
            ],
            status: Response::HTTP_OK,
        );
    }
}