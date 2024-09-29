<?php

declare(strict_types=1);

namespace App\Schema;

final class UserSchema extends AbstractBaseSchema
{
    protected string $email;

    protected string $name;

    protected string $surName;

    protected string $password;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): UserSchema
    {
        $this->email = $email;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): UserSchema
    {
        $this->name = $name;

        return $this;
    }

    public function getSurName(): string
    {
        return $this->surName;
    }

    public function setSurName(string $surName): UserSchema
    {
        $this->surName = $surName;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): UserSchema
    {
        $this->password = $password;

        return $this;
    }

    public static function fromArray(array $data): self
    {
        return (new self())
            ->setName($data['name'])
            ->setSurName($data['surName'])
            ->setEmail($data['email'])
            ->setPassword($data['password']);
    }

}