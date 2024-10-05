<?php

declare(strict_types=1);

namespace App\Controller\API\Auth;

use App\Helper\RequestHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class LoginController extends AbstractController
{
    #[Route('/api/auth/login', name: 'auth.login', methods: ['POST'])]
    public function login(Request $request): JsonResponse
    {
        return new JsonResponse([
            'message' => 'Login successful',
        ]);
    }
}