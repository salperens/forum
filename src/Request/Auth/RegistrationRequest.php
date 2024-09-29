<?php

declare(strict_types=1);

namespace App\Request\Auth;

use App\Request\AbstractBaseRequest;
use App\Schema\UserSchema;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

final class RegistrationRequest extends AbstractBaseRequest
{
    #[NotBlank]
    #[Email]
    public string $email;

    #[NotBlank]
    #[Type('string')]
    #[Length(min: 3, max: 50)]
    public string $name;

    #[NotBlank]
    #[Type('string')]
    #[Length(min: 3, max: 50)]
    public string $surName;

    #[NotBlank]
    #[Type('string')]
    #[Length(min: 6, max: 50)]
    public string $password;

    public function toSchema(): UserSchema
    {
        return (new UserSchema())
            ->setName($this->name)
            ->setSurName($this->surName)
            ->setEmail($this->email)
            ->setPassword($this->password);
    }
}