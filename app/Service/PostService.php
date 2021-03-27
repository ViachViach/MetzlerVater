<?php

declare(strict_types=1);

namespace App\Service;

use App\Adapter\PostAdapter;
use App\DTO\Controller\Request\PostCreateRequest;
use App\DTO\Controller\Response\PostResponse;
use App\Models\Post;
use App\Repository\PostRepository;
use Illuminate\Contracts\Queue\EntityNotFoundException;

class PostService implements PostServiceInterface
{
    public function __construct(
        private PostRepository $postRepository
    ) { }

    public function create(PostCreateRequest $request): PostResponse
    {
        $post = Post::create([
            'title' => $request->getTitle(),
            'text'  => $request->getText(),
        ]);

        $response = new PostAdapter($post);
        return $response->createResponse();
    }

    public function update(PostCreateRequest $request, int $id): PostResponse
    {
        $post = Post::where('id', $id)->update([
            'title' => $request->getTitle(),
            'text'  => $request->getText(),
        ]);

        $response = new PostAdapter($post);
        return $response->createResponse();
    }

    public function getById(int $id): Post
    {
        $post = $this->postRepository->findById($id);

        if ($post === null) {
            throw new EntityNotFoundException('Post', $id);
        }

        return $post;
    }

    public function getResponseById(int $id): PostResponse
    {
        $response = new PostAdapter($this->getById($id));
        return $response->createResponse();
    }

    /**
     * @inheritDoc
    */
    public function getAll(): array
    {
        $posts = $this->postRepository->findAll();

        $result = [];
        foreach ($posts as $post) {
            $response = new PostAdapter($post);
            $result[] = $response->createResponse();
        }

        return $result;
    }
}
