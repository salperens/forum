<?php

declare(strict_types=1);

namespace App\Manager;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Schema\UserSchema;
use App\Trait\JWTTokenTrait;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

final class RegisterManager
{
    use JWTTokenTrait;
    private UserSchema $registeredUser;
    
    private User $user;

    private string $token;

    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly JWTTokenManagerInterface $JWTManager
    )
    {
    }

    public function setRegisteredUser(UserSchema $userSchema): self
    {
        $this->registeredUser = $userSchema;

        return $this;
    }

    public function isExists(): bool
    {
        return $this->userRepository->isEmailExists($this->registeredUser->getEmail());
    }

    public function saveUser(): self
    {
        $this->user = $this->userRepository->create($this->registeredUser);

        return $this;
    }

    public function createAuthToken(): self
    {
        $this->token = $this->createTokenForUser($this->user);

        return $this;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}