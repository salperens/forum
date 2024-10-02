<?php

declare(strict_types=1);

namespace App\Controller\API\Auth;

use App\Request\Auth\RegistrationRequest;
use App\Response\Auth\RegistrationSuccessfulResponse;
use App\Service\Auth\RegisterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/auth')]
final class RegistrationController extends AbstractController
{

    public function __construct(
        private readonly RegisterService $registrationService,
    )
    {
    }

    #[Route('/registration', name: 'auth.registration', methods: ['POST'])]
    public function registration(RegistrationRequest $request): JsonResponse
    {
        $token = $this->registrationService->registerUser($request->toSchema());

        return (new RegistrationSuccessfulResponse($token))->response();
    }
}