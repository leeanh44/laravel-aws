<?php

namespace Modules\Api\Http\Controllers\V1;

use Modules\Api\Http\Controllers\BaseController;
use Modules\Api\Contracts\Services\ShopService;
use Modules\Api\Transformers\ShopResource;
use Modules\Api\Transformers\SuccessPaginationResource;

class ShopController extends BaseController
{
    /**
     * @var ShopService
     */
    private $shopService;

    public function __construct(ShopService $shopService)
    {
        $this->shopService = $shopService;
    }

    /**
     * Shop detail.
     *
     * @OA\Get(
     *      path="/v1/shop/{id}",
     *      tags={"SHOP"},
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
     *          content={
     *              @OA\MediaType(
     *                  mediaType="application/json",
     *                  @OA\Schema(
     *                      properties={
     *                          @OA\Property(
     *                              property="data",
     *                              type="object",
     *                              ref="#/components/schemas/ShopResource",
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
     *     ),
     *     security={
     *         {"BearerAuth": {}}
     *     }
     * )
     * @param integer $shopId
     * @return ShopResource
     */
    public function detail(int $shopId): ShopResource
    {
        $shop = $this->shopService->findById($shopId);

        return ShopResource::make($shop);
    }

    /**
     * List shop by master category.
     *
     * @OA\Get(
     *      path="/v1/master-category/{id}/shops",
     *      tags={"MASTER CATEGORY"},
     *      @OA\Parameter(
     *          name="id",
     *          description="Master category id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(type="integer")
     *      ),
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
     *                              @OA\Items(ref="#/components/schemas/ShopResource")
     *                          ),
     *                          @OA\Property(
     *                              property="meta",
     *                              type="object",
     *                              @OA\Property(property="code", type="integer", example=200),
     *                              @OA\Property(property="message", type="string", example="Successful")
     *                          )
     *                      }
     *                  )
     *              )
     *          }
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
     * @param integer $masterCategoryId
     * @return SuccessPaginationResource
     */
    public function listShopByMasterCategory(int $masterCategoryId): SuccessPaginationResource
    {
        $shops = $this->shopService->listShopByMasterCategory($masterCategoryId);

        return SuccessPaginationResource::make($shops);
    }
}
