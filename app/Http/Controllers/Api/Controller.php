<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Annotations as OA;

/**
 * @OA\Response(
 *     response="401",
 *     description="Unauthorized",
 * )
 * @OA\SecurityScheme(
 *     type="http",
 *     description="Value: Bearer {jwt}",
 *     name="Token based Based",
 *     in="header",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     securityScheme="apiAuth",
 * )
 */
class Controller extends BaseController
{
    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Integration Swagger in Larave",
     *      description="Implementation of Swagger with in Laravel",
     *      @OA\Contact(
     *          email="vyacheslavkarmazin@gmail.com"
     *      )
     * )
     */
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
