<?php

declare(strict_types=1);

namespace App\Adapter;

use App\DTO\Controller\Response\UserResponse;
use App\Models\User;

class UserAdapter
{
    public function __construct(
        private User $user
    ) { }

    public function createResponse(): UserResponse
    {
        $result = new UserResponse();
        $result
            ->setId($this->user->id)
            ->setEmail($this->user->email)
            ->setName($this->user->name)
        ;

        return $result;
    }
}
