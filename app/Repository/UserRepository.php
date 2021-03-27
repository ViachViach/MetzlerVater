<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    public function findById(int $id): ?User
    {
        return User::find($id);
    }

    /**
     * @return User[]|Collection
     */
    public function findAll(): array|Collection
    {
        return User::all();
    }
}
