<?php

namespace Modules\Api\Http\Controllers\V1;

use Modules\Api\Http\Controllers\BaseController;
use Modules\Api\Contracts\Services\ProductService;
use Modules\Api\Transformers\SuccessPaginationResource;
use Modules\Api\Transformers\ProductResource;
use Modules\Api\Transformers\ErrorResource;

class ProductController extends BaseController
{
    /**
     * @var ProductService
     */
    private $productService;

    public function __construct(
        ProductService $productService
    ) {
        $this->productService = $productService;
    }

    /**
     * List product by sub category.
     *
     * @OA\Get(
     *      path="/v1/products/sub-category/{id}",
     *      tags={"PRODUCTS"},
     *      @OA\Parameter(
     *          name="id",
     *          description="Sub category id",
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
     *                              @OA\Items(ref="#/components/schemas/ProductResource"),
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
     * @param integer $subCategoryId
     * @return SuccessPaginationResource
     */
    public function listBySubCategory(int $subCategoryId) : SuccessPaginationResource
    {
        $products = $this->productService->listBySubCategory($subCategoryId);

        return SuccessPaginationResource::make($products);
    }

    /**
     * Detail product.
     *
     * @OA\Get(
     *      path="/v1/products/{id}",
     *      tags={"PRODUCTS"},
     *      @OA\Parameter(
     *          name="id",
     *          description="Product id",
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
     *                              @OA\Items(ref="#/components/schemas/ProductResource"),
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
     *      ),
     *     security={
     *         {"BearerAuth": {}}
     *     }
     * )
     * @param integer $id
     * @return ProductResource|ErrorResource
     */
    public function detail(int $id)
    {
        $product = $this->productService->findById($id);
        if ($product) {
            return ProductResource::make($product);
        }

        return new ErrorResource(404, 'Not found');
    }
}
