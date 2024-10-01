<?php

declare(strict_types=1);

namespace App\Service\Auth;

use App\Exception\EmailAlreadyExistsException;
use App\Manager\RegisterManager;
use App\Schema\UserSchema;

final class RegisterService
{

    public function __construct(
        private readonly RegisterManager $registerManager,
    )
    {

    }

    public function registerUser(UserSchema $user): string
    {
        $this->registerManager->setRegisteredUser($user);

        if ($this->registerManager->isExists()) {
            throw EmailAlreadyExistsException::make($user->getEmail());
        }

        $this->registerManager
            ->saveUser()
            ->createAuthToken();

        return $this->registerManager->getToken();
    }
}