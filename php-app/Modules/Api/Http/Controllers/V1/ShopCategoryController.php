<?php

namespace Modules\Api\Http\Controllers\V1;

use Modules\Api\Http\Controllers\BaseController;
use Modules\Api\Contracts\Services\CategoryService;
use Modules\Api\Transformers\CategoryResource;

class ShopCategoryController extends BaseController
{
    /**
     * @var CategoryService
     */
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * List category by shop
     *
     * @OA\Get(
     *      path="/v1/shop/{id}/categories",
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
     *                              type="array",
     *                              @OA\Items(ref="#/components/schemas/CategoryResource"),
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
     * @return CategoryResource
     */
    public function index(int $shopId): CategoryResource
    {
        $categories = $this->categoryService->list($shopId);

        return CategoryResource::make($categories);
    }
}
