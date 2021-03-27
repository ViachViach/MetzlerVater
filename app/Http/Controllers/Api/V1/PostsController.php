<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\DTO\Controller\Request\PostCreateRequest;
use App\Http\Controllers\Api\Controller;
use App\Service\PostServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @OA\Tag(name="Posts")
 */
class PostsController extends Controller
{
    public function __construct(
        private PostServiceInterface $postService,
        private SerializerInterface $serializer
    ) { }

    /**
     * @OA\Post (
     *    tags={"Posts"},
     *    path="/api/v1/post",
     *    security={{"bearer_token":{}}},
     *    description="Create post",
     *    summary="Return post",
     *    @OA\RequestBody(
     *      @OA\JsonContent(
     *          type="object",
     *          @OA\Property(
     *              property="title",
     *              nullable=true,
     *              description="Title of post",
     *              type="string"
     *          ),
     *          @OA\Property(
     *              property="text",
     *              nullable=false,
     *              description="text of post",
     *              type="string"
     *          ),
     *      ),
     *    ),
     *    @OA\Response(
     *      response=200,
     *      description="Array of posts",
     *    )
     * )
     */
    public function create(Request $request): JsonResponse
    {
        $postCreateRequest = $this->serializer->deserialize(
            $request->getContent(),
            PostCreateRequest::class,
            JsonEncoder::FORMAT
        );

        $this->postService->create($postCreateRequest);

        return new JsonResponse();
    }

    /**
     * @OA\Put (
     *    tags={"Posts"},
     *    security={{"bearer_token":{}}},
     *    path="/api/v1/post/{id}",
     *    description="Create post",
     *    summary="Return post",
     *    @OA\Parameter(
     *        name="id",
     *        in="path",
     *        required=true,
     *        description="post id",
     *    ),
     *    @OA\RequestBody(
     *      @OA\JsonContent(
     *          type="object",
     *          @OA\Property(
     *              property="title",
     *              nullable=true,
     *              description="Title of post",
     *              type="string"
     *          ),
     *          @OA\Property(
     *              property="text",
     *              nullable=false,
     *              description="text of post",
     *              type="string"
     *          ),
     *      ),
     *    ),
     *    @OA\Response(
     *      response=200,
     *      description="Array of posts",
     *      @OA\JsonContent(
     *          type="object",
     *          @OA\Property(
     *              property="id",
     *              nullable=true,
     *              description="post id",
     *              type="integer"
     *          ),
     *          @OA\Property(
     *              property="title",
     *              nullable=true,
     *              description="Title of post",
     *              type="string"
     *          ),
     *          @OA\Property(
     *              property="date",
     *              nullable=false,
     *              example="2017-01-01",
     *              description="Create date",
     *              type="string"
     *          ),
     *          @OA\Property(
     *              property="text",
     *              nullable=false,
     *              description="text of post",
     *              type="string"
     *          ),
     *      ),
     *    ),
     * )
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $postCreateRequest = $this->serializer->deserialize(
            $request->getContent(),
            PostCreateRequest::class,
            JsonEncoder::FORMAT
        );

        $post = $this->postService->update($postCreateRequest, $id);
        $data = $this->serializer->serialize($post,JsonEncoder::FORMAT);

        return new JsonResponse($data, JsonResponse::HTTP_OK);
    }

    /**
     * @OA\Get(
     *    tags={"Posts"},
     *    path="/api/v1/post/{id}",
     *    description="Get post",
     *    summary="Return post",
     *    @OA\Parameter(
     *        name="id",
     *        in="path",
     *        required=true,
     *        description="post id",
     *    ),
     *    @OA\Response(
     *        response=200,
     *        description="Array of posts",
     *        @OA\JsonContent(
     *            @OA\Property(
     *                property="id",
     *                nullable=true,
     *                description="post id",
     *                type="integer"
     *            ),
     *            @OA\Property(
     *                property="title",
     *                nullable=true,
     *                description="Title of post",
     *                type="string"
     *            ),
     *            @OA\Property(
     *                property="date",
     *                nullable=false,
     *                example="2017-01-01",
     *                description="Create date",
     *                type="string"
     *            ),
     *            @OA\Property(
     *                property="text",
     *                nullable=false,
     *                description="text of post",
     *                type="string"
     *            ),
     *        ),
     *    ),
     * )
     */
    public function getById(int $id): JsonResponse
    {
        $post = $this->postService->getById($id);
        $data = $this->serializer->serialize($post,JsonEncoder::FORMAT);

        return new JsonResponse($data, JsonResponse::HTTP_OK);
    }

    /**
     * @OA\Get(
     *    tags={"Posts"},
     *    path="/api/v1/post",
     *    description="Get posts",
     *    summary="Return posts",
     *    @OA\Response(
     *        response=200,
     *        description="Array of post",
     *        @OA\JsonContent(
     *            type="array",
     *            @OA\Items(
     *                @OA\Property(
     *                   property="id",
     *                   nullable=true,
     *                   description="post id",
     *                   type="integer"
     *                ),
     *                @OA\Property(
     *                   property="title",
     *                   nullable=true,
     *                   description="Title of post",
     *                   type="string"
     *                ),
     *                @OA\Property(
     *                    property="date",
     *                    nullable=false,
     *                    example="2017-01-01",
     *                    description="Create date",
     *                    type="string"
     *                ),
     *                @OA\Property(
     *                    property="text",
     *                    nullable=false,
     *                    description="text of post",
     *                    type="string"
     *                ),
     *            ),
     *        ),
     *    ),
     * )
     */
    public function getAll(): JsonResponse
    {
        $post = $this->postService->getAll();
        $data = $this->serializer->serialize($post,JsonEncoder::FORMAT);

        return new JsonResponse($data, JsonResponse::HTTP_OK);
    }
}
