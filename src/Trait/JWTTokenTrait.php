<?php

declare(strict_types=1);

namespace App\Trait;

use App\Entity\User;
use App\Manager\RegisterManager;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

/**
 * @mixin RegisterManager
 */
trait JWTTokenTrait
{
    public function __construct(private readonly JWTTokenManagerInterface $JWTTokenManager)
    {
    }

    protected function createTokenForUser(User $user): string
    {
        return $this->JWTTokenManager->create($user);
    }
}