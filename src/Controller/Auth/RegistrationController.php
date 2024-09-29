<?php

declare(strict_types=1);

namespace App\Controller\Auth;

use App\Request\Auth\RegistrationRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/auth')]
final class RegistrationController extends AbstractController
{
    #[Route('/registration', name: 'auth.registration', methods: ['POST'])]
    public function registration(RegistrationRequest $request): JsonResponse
    {


        return new JsonResponse(['message' => 'Registration successful']);
    }
}