<?php

declare(strict_types=1);

namespace App\DTO\Controller\Request;

use DateTimeInterface;

class PostCreateRequest
{
    private string $title;
    private string $text;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }
}
