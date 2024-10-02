<?php

namespace App\Controller\API\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/user/profile')]
class ProfileController extends AbstractController
{
    #[Route('/create', name: 'app_user_profile')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UserProfileController.php',
        ]);
    }
}
