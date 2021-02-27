<?php

namespace Modules\Api\Http\Controllers\V1;

use Log;
use Exception;
use Modules\Api\Http\Controllers\BaseController;
use Modules\Api\Http\Requests\UpdateUserRequest;
use Modules\Api\Http\Requests\UpdateUserDeviceRequest;
use Modules\Api\Contracts\Services\UserService;
use Modules\Api\Contracts\Adapters\JWTAuthAdapter;
use Modules\Api\Transformers\UserResource;
use Modules\Api\Transformers\SuccessResource;
use Modules\Api\Transformers\ErrorResource;
use Modules\Api\Entities\User;

class UserController extends BaseController
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * @var JWTAuthAdapter
     */
    private $jwtAuthAdapter;

    /**
     * @var User
     */
    private $user;

    public function __construct(
        JWTAuthAdapter $jwtAuthAdapter,
        UserService $userService
    ) {
        $this->jwtAuthAdapter = $jwtAuthAdapter;
        $this->user = $this->jwtAuthAdapter->parseToken();
        $this->userService = $userService;
    }

    /**
     * Get user profile.
     *
     * @OA\Get(
     *      path="/v1/user",
     *      tags={"USER"},
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent(ref="#/components/schemas/UserResource")
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorResource"),
     *     ),
     *     security={
     *         {"BearerAuth": {}}
     *     }
     * )
     * @return UserResource
     */
    public function detail()
    {
        return UserResource::make($this->user);
    }

    /**
     * Update user profile.
     *
     * @OA\Post(
     *      path="/v1/user",
     *      tags={"USER"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateUserRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent(ref="#/components/schemas/SuccessResource")
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorResource"),
     *     ),
     *     security={
     *         {"BearerAuth": {}}
     *     }
     * )
     * @param UpdateUserRequest $request
     * @return SuccessResource|ErrorResource
     */
    public function update(UpdateUserRequest $request)
    {
        try {
            $this->userService->update($request->onlyFields(), $this->user->id);
            return new SuccessResource();
        } catch (Exception $e) {
            Log::error('[ERROR_UPDATE_USER]: '. $e->getMessage());

            return new ErrorResource(400, $e->getMessage());
        }//end try
    }

    /**
     * Update user device.
     *
     * @OA\Post(
     *      path="/v1/user/devices",
     *      tags={"USER"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateUserDeviceRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent(ref="#/components/schemas/SuccessResource")
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorResource"),
     *     ),
     *     security={
     *         {"BearerAuth": {}}
     *     }
     * )
     * @param UpdateUserDeviceRequest $request
     * @return SuccessResource|ErrorResource
     */
    public function updateDevice(UpdateUserDeviceRequest $request)
    {
        try {
            $data = $request->onlyFields();
            $data['user_id'] = $this->user->id;
            $attributes = [
                'device_id' => $data['device_id']
            ];
            $this->userService->updateDevice($attributes, $data);

            return new SuccessResource();
        } catch (Exception $e) {
            Log::error('[UPDATE_USER_DEVICE_ERROR] =>' . $e->getMessage());

            return new ErrorResource(400, $e->getMessage());
        }
    }
}
