<?php

declare(strict_types=1);

namespace App\DTO\Controller\Request;

class UserCreateRequest
{
    private string $name;
    private string $email;
    private string $password;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): UserCreateRequest
    {
        $this->name = $name;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): UserCreateRequest
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): UserCreateRequest
    {
        $this->password = $password;
        return $this;
    }
}
