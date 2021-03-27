<?php

declare(strict_types=1);

namespace App\DTO\Controller\Response;

class UserResponse
{
    private int $id;
    private string $name;
    private string $email;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): UserResponse
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): UserResponse
    {
        $this->name = $name;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): UserResponse
    {
        $this->email = $email;
        return $this;
    }
}
