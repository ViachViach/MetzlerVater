<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Tag(name="Token")
 */
class AuthController extends Controller
{
    /**
     * @OA\Post(
     *   path="/api/v1/token/login",
     *   tags={"Token"},
     *   summary="Token",
     *   @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="password",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *      description="Success",
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     * )
     */
    public function login(): JsonResponse
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return new JsonResponse(['error' => 'Unauthorized'], JsonResponse::HTTP_UNAUTHORIZED);
        }

        return new JsonResponse([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => (auth()->factory()->getTTL() * 60),
        ], JsonResponse::HTTP_OK);
    }

    /**
     * @OA\Post(
     *   path="/api/v1/token/refresh",
     *   tags={"Token"},
     *   summary="Token",
     *   @OA\Response(
     *      response=200,
     *      description="Success",
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     * )
     */
    public function refresh(): JsonResponse
    {
        return new JsonResponse([
            'access_token' => auth()->refresh(),
            'token_type'   => 'bearer',
            'expires_in'   => (auth()->factory()->getTTL() * 60),
        ], JsonResponse::HTTP_OK);
    }
}
