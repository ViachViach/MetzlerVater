<?php

declare(strict_types=1);

namespace App\Adapter;

use App\DTO\Controller\Response\PostResponse;
use App\Models\Post;

class PostAdapter
{
    public function __construct(
        private Post $post
    ) { }

    public function createResponse(): PostResponse
    {
        $result = new PostResponse();
        $result
            ->setId($this->post->id)
            ->setTitle($this->post->title)
            ->setText($this->post->text)
            ->setDate($this->post->created_at->isoFormat('Y-D-mm'))
        ;

        return $result;
    }
}
