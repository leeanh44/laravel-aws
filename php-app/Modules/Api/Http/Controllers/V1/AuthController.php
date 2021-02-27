<?php

namespace Modules\Api\Http\Controllers\V1;

use Modules\Api\Contracts\Services\AuthService;
use Modules\Api\Http\Requests\AuthLoginRequest;
use Modules\Api\Http\Requests\AuthVerifyPhoneRequest;
use Modules\Api\Repositories\Parameters\AuthLoginParam;
use Modules\Api\Transformers\AuthResource;
use Modules\Api\Transformers\SuccessResource;
use Modules\Api\Http\Controllers\BaseController;

class AuthController extends BaseController
{
    /** @var AuthService */
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * User login
     *
     * @OA\Post(
     *     path="/v1/login",
     *     tags={"AUTH"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/AuthLoginRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful",
     *         @OA\JsonContent(ref="#/components/schemas/SuccessResource")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResource"),
     *     )
     * )
     * @param AuthLoginRequest $request
     * @return AuthResource
     */
    public function login(AuthLoginRequest $request): AuthResource
    {
        $params = new AuthLoginParam($request->input('email'), $request->input('password'));
        $auth = $this->authService->login($params);

        return AuthResource::make($auth);
    }

    public function testAuth(): SuccessResource
    {
        return new SuccessResource();
    }

    /**
     * User verify phone
     *
     * @OA\Post(
     *      path="/v1/phone/verify",
     *      tags={"AUTH"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/AuthVerifyPhoneRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *          content={
     *              @OA\MediaType(
     *                  mediaType="application/json",
     *                  @OA\Schema(
     *                      properties={
     *                          @OA\Property(
     *                              property="data",
     *                              type="object",
     *                              ref="#/components/schemas/AuthResource",
     *                          ),
     *                          @OA\Property(
     *                              property="meta",
     *                              type="object",
     *                              @OA\Property(property="code", type="integer", example=200),
     *                              @OA\Property(property="message", type="string", example="Successful")
     *                          ),
     *                      }
     *                  )
     *              )
     *          }
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorResource"),
     *      )
     * )
     * @param AuthVerifyPhoneRequest $request
     * @return AuthResource
     */
    public function verifyPhone(AuthVerifyPhoneRequest $request): AuthResource
    {
        $auth = $this->authService->verifyPhone($request->phone);

        return AuthResource::make($auth);
    }
}
