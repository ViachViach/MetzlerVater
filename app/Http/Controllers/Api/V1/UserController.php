<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\DTO\Controller\Request\UserCreateRequest;
use App\Service\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @OA\Tag(name="User")
 */
class UserController
{
    public function __construct(
        private UserServiceInterface $userService,
        private SerializerInterface $serializer
    ) { }

    /**
     * @OA\Post (
     *    tags={"User"},
     *    path="/api/v1/user",
     *    security={{"bearer_token":{}}},
     *    description="Create user",
     *    summary="Return user",
     *    @OA\RequestBody(
     *      @OA\JsonContent(
     *          type="object",
     *          @OA\Property(
     *              property="name",
     *              nullable=true,
     *              description="Name of user",
     *              type="string"
     *          ),
     *          @OA\Property(
     *              property="email",
     *              nullable=false,
     *              example="test@gmail.com",
     *              description="Email",
     *              type="string"
     *          ),
     *          @OA\Property(
     *              property="password",
     *              nullable=false,
     *              description="Password",
     *              type="string"
     *          ),
     *      ),
     *    ),
     *    @OA\Response(
     *      response=200,
     *      description="Array of user",
     *    )
     * )
     */
    public function create(Request $request): JsonResponse
    {
        $userCreateRequest = $this->serializer->deserialize(
            $request->getContent(),
            UserCreateRequest::class,
            JsonEncoder::FORMAT
        );

        $this->userService->create($userCreateRequest);

        return new JsonResponse();
    }

    /**
     * @OA\Put (
     *    tags={"User"},
     *    security={{"bearer_token":{}}},
     *    path="/api/v1/user/{id}",
     *    description="Create user",
     *    summary="Return user",
     *    @OA\Parameter(
     *        name="id",
     *        in="path",
     *        required=true,
     *        description="user id",
     *    ),
     *    @OA\Response(
     *      response=200,
     *      description="Array of users",
     *      @OA\JsonContent(
     *          type="object",
     *          @OA\Property(
     *              property="id",
     *              nullable=true,
     *              description="user id",
     *              type="integer"
     *          ),
     *          @OA\Property(
     *              property="name",
     *              nullable=true,
     *              description="Name of user",
     *              type="string"
     *          ),
     *          @OA\Property(
     *              property="email",
     *              nullable=false,
     *              example="test@gmail.com",
     *              description="Email",
     *              type="string"
     *          ),
     *          @OA\Property(
     *              property="password",
     *              nullable=false,
     *              description="Password",
     *              type="string"
     *          ),
     *      ),
     *    ),
     * )
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $userCreateRequest = $this->serializer->deserialize(
            $request->getContent(),
            UserCreateRequest::class,
            JsonEncoder::FORMAT
        );

        $user = $this->userService->update($userCreateRequest, $id);
        $data = $this->serializer->serialize($user,JsonEncoder::FORMAT);

        return new JsonResponse($data, JsonResponse::HTTP_OK);
    }

    /**
     * @OA\Get(
     *    tags={"User"},
     *    path="/api/v1/user/{id}",
     *    security={{"bearer_token":{}}},
     *    description="Get user",
     *    summary="Return user",
     *    @OA\Parameter(
     *        name="id",
     *        in="path",
     *        required=true,
     *        description="user id",
     *    ),
     *    @OA\Response(
     *        response=200,
     *        description="Array of user",
     *        @OA\JsonContent(
     *          @OA\Property(
     *              property="id",
     *              nullable=true,
     *              description="user id",
     *              type="integer"
     *          ),
     *          @OA\Property(
     *              property="name",
     *              nullable=true,
     *              description="Name of user",
     *              type="string"
     *          ),
     *          @OA\Property(
     *              property="email",
     *              nullable=false,
     *              example="test@gmail.com",
     *              description="Email",
     *              type="string"
     *          ),
     *          @OA\Property(
     *              property="password",
     *              nullable=false,
     *              description="Password",
     *              type="string"
     *          ),
     *        ),
     *    ),
     * )
     */
    public function getById(int $id): JsonResponse
    {
        $user = $this->userService->getById($id);
        $data = $this->serializer->serialize($user,JsonEncoder::FORMAT);

        return new JsonResponse($data, JsonResponse::HTTP_OK);
    }

    /**
     * @OA\Get(
     *    tags={"User"},
     *    path="/api/v1/user",
     *    security={{"bearer_token":{}}},
     *    description="Get users",
     *    summary="Return user",
     *    @OA\Response(
     *        response=200,
     *        description="Array of user",
     *        @OA\JsonContent(
     *            type="array",
     *            @OA\Items(
     *                @OA\Property(
     *                    property="id",
     *                    nullable=true,
     *                    description="user id",
     *                    type="integer"
     *                ),
     *                @OA\Property(
     *                    property="name",
     *                    nullable=true,
     *                    description="Name of user",
     *                    type="string"
     *                ),
     *                @OA\Property(
     *                    property="email",
     *                    nullable=false,
     *                    example="test@gmail.com",
     *                    description="Email",
     *                    type="string"
     *                ),
     *                @OA\Property(
     *                    property="password",
     *                    nullable=false,
     *                    description="Password",
     *                    type="string"
     *                ),
     *            ),
     *        ),
     *    ),
     * )
     */
    public function getAll(): JsonResponse
    {
        $user = $this->userService->getAll();
        $data = $this->serializer->serialize($user,JsonEncoder::FORMAT);

        return new JsonResponse($data, JsonResponse::HTTP_OK);
    }
}
