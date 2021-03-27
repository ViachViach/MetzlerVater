<?php

declare(strict_types=1);

namespace App\Service;

use App\Adapter\UserAdapter;
use App\DTO\Controller\Request\UserCreateRequest;
use App\DTO\Controller\Response\UserResponse;
use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Contracts\Queue\EntityNotFoundException;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    public function __construct(
        private UserRepository $userRepository
    ) { }


    public function create(UserCreateRequest $request): UserResponse
    {
        $user = User::create([
            'name'     => $request->getName(),
            'email'    => $request->getEmail(),
            'password' => Hash::make($request->getPassword()),
        ]);

        $response = new UserAdapter($user);
        return $response->createResponse();
    }

    public function update(UserCreateRequest $request, int $id): UserResponse
    {
        $user = User::where('id', $id)->update([
            'name'     => $request->getName(),
            'email'    => $request->getEmail(),
            'password' => Hash::make($request->getText()),
        ]);

        $response = new UserAdapter($user);
        return $response->createResponse();
    }

    public function getById(int $id): User
    {
        $user = $this->userRepository->findById($id);

        if ($user === null) {
            throw new EntityNotFoundException('User', $id);
        }

        return $user;
    }

    public function getResponseById(int $id): UserResponse
    {
        $response = new UserAdapter($this->getById($id));
        return $response->createResponse();
    }

    public function getAll(): array
    {
        $users = $this->userRepository->findAll();

        $result = [];
        foreach ($users as $user) {
            $response = new UserAdapter($user);
            $result[] = $response->createResponse();
        }

        return $result;
    }
}
