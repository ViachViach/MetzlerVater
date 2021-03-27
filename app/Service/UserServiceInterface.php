<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\Controller\Request\UserCreateRequest;
use App\DTO\Controller\Response\UserResponse;
use App\Models\User;

interface UserServiceInterface
{
    public function create(UserCreateRequest $request): UserResponse;
    public function update(UserCreateRequest $request, int $id): UserResponse;
    public function getById(int $id): User;
    public function getResponseById(int $id): UserResponse;

    /**
     * @return UserResponse[]
     */
    public function getAll(): array;
}
