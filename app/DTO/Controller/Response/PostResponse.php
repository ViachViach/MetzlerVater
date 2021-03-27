<?php

declare(strict_types=1);

namespace App\DTO\Controller\Response;

use DateTimeInterface;

class PostResponse
{
    private int $id;
    private string $title;
    private string $date;
    private string $text;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): PostResponse
    {
        $this->id = $id;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): PostResponse
    {
        $this->title = $title;
        return $this;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): PostResponse
    {
        $this->date = $date;
        return $this;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): PostResponse
    {
        $this->text = $text;
        return $this;
    }

}
