<?php

declare(strict_types=1);

namespace App\Providers;

use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Service\PostService;
use App\Service\PostServiceInterface;
use App\Service\UserService;
use App\Service\UserServiceInterface;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(PostServiceInterface::class, function () {
            return new PostService(
                $this->app->get(PostRepository::class)
            );
        });

        $this->app->bind(UserServiceInterface::class, function () {
            return new UserService(
                $this->app->get(UserRepository::class)
            );
        });

        $this->app->bind(SerializerInterface::class, function () {
            return new Serializer([new ObjectNormalizer()], [$this->app->get(JsonEncoder::class)]);
        });
    }
}
