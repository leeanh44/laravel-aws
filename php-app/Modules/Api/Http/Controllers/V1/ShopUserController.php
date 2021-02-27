<?php

namespace Modules\Api\Http\Controllers\V1;

use Log;
use Exception;
use Modules\Api\Http\Controllers\BaseController;
use Modules\Api\Http\Requests\StoreShopUserRequest;
use Modules\Api\Contracts\Services\ShopUserService;
use Modules\Api\Contracts\Adapters\JWTAuthAdapter;
use Modules\Api\Transformers\ShopUserResource;
use Modules\Api\Transformers\SuccessResource;
use Modules\Api\Transformers\SuccessPaginationResource;
use Modules\Api\Transformers\ErrorResource;
use Modules\Api\Entities\User;

class ShopUserController extends BaseController
{
    /**
     * @var ShopUserService
     */
    private $shopUserService;

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
        ShopUserService $shopUserService
    ) {
        $this->jwtAuthAdapter = $jwtAuthAdapter;
        $this->user = $this->jwtAuthAdapter->parseToken();
        $this->shopUserService = $shopUserService;
    }

    /**
     * List my shop.
     *
     * @OA\Get(
     *      path="/v1/user/shops",
     *      tags={"USER"},
     *      @OA\Parameter(
     *          name="page",
     *          description="Page",
     *          required=false,
     *          in="query",
     *          @OA\Schema(type="integer")
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
     *                              type="array",
     *                              @OA\Items(ref="#/components/schemas/ShopUserResource"),
     *                          ),
     *                          @OA\Property(
     *                              property="meta",
     *                              type="object",
     *                              @OA\Property(property="code", type="integer", example=200),
     *                              @OA\Property(property="message", type="string", example="Successful"),
     *                              @OA\Property(
     *                                  property="pagination",
     *                                  type="object",
     *                                  ref="#/components/schemas/SuccessPaginationResource",
     *                              ),
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
     *      ),
     *     security={
     *         {"BearerAuth": {}}
     *     }
     * )
     * @return SuccessPaginationResource
     */
    public function index() : SuccessPaginationResource
    {
        $shops = $this->shopUserService->listByUser($this->user->id);

        return SuccessPaginationResource::make($shops);
    }

    /**
     * Register shop user.
     *
     * @OA\Post(
     *      path="/v1/user/shop",
     *      tags={"USER"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreShopUserRequest")
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
     * @param StoreShopUserRequest $request
     * @return SuccessResource|ErrorResource
     */
    public function store(StoreShopUserRequest $request)
    {
        try {
            $data = $request->onlyFields();
            $attributes = [
                'user_id' => $this->user->id,
                'shop_id' => $data['shop_id'],
            ];
            $this->shopUserService->updateOrCreate($attributes, $data);
    
            return new SuccessResource();
        } catch (Exception $e) {
            Log::error('[ERROR_REGISTER_SHOP_USER]: '. $e->getMessage());

            return new ErrorResource(400, $e->getMessage());
        }//end try
    }

    /**
     * My shop detail.
     *
     * @OA\Get(
     *      path="/v1/user/shops/{id}",
     *      tags={"USER"},
     *      @OA\Parameter(
     *          name="id",
     *          description="Shop id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent(ref="#/components/schemas/ShopUserResource")
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
     * @param integer $shopId
     * @return ShopUserResource|ErrorResource
     */
    public function detail(int $shopId)
    {
        $shopUser = $this->shopUserService->findShopUser($shopId, $this->user->id);
        if ($shopUser) {
            return ShopUserResource::make($shopUser);
        }

        return new ErrorResource(404, 'Not found');
    }
}
