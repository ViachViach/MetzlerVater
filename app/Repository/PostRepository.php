<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

class PostRepository
{
    public function findById(int $id): ?Post
    {
        return Post::find($id);
    }

    /**
     * @return Post[]|Collection
     */
    public function findAll(): array|Collection
    {
        return Post::all();
    }
}
