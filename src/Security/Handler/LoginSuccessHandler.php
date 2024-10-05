<?php

declare(strict_types=1);

namespace App\Security\Handler;

use App\Entity\User;
use App\Response\Auth\LoginSuccessfulResponse;
use App\Trait\JWTTokenTrait;
use Symfony\Component\HttpFoundation\{Request, JsonResponse};
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

final class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    use JWTTokenTrait;

    /**
     * Handles successful authentication by generating a JWT token for the authenticated user.
     *
     * @param Request $request The request that resulted in an AuthenticationException
     * @param TokenInterface $token The token that was created during authentication
     *
     * @return JsonResponse A response which includes the JWT token
     *
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token): JsonResponse
    {
        /** @var User $user */
        $user = $token->getUser();

        $jwtToken = $this->createTokenForUser($user);

        return (new LoginSuccessfulResponse($user, $jwtToken))->response();
    }
}