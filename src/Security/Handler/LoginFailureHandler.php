<?php

declare(strict_types=1);

namespace App\Security\Handler;

use App\Response\Auth\LoginFailureResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;

final class LoginFailureHandler implements AuthenticationFailureHandlerInterface
{

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): Response
    {
        return (new LoginFailureResponse($exception->getMessage()))->response();
    }
}