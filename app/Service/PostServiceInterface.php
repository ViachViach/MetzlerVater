<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\Controller\Request\PostCreateRequest;
use App\DTO\Controller\Response\PostResponse;
use App\Models\Post;

interface PostServiceInterface
{
    public function create(PostCreateRequest $request): PostResponse;
    public function update(PostCreateRequest $request, int $id): PostResponse;
    public function getById(int $id): Post;
    public function getResponseById(int $id): PostResponse;

    /**
     * @return PostResponse[]
    */
    public function getAll(): array;
}
