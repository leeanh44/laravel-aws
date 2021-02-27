<?php

namespace Modules\Api\Http\Controllers\V1;

use Modules\Api\Http\Controllers\BaseController;
use Modules\Api\Contracts\Services\MasterCategoryService;
use Modules\Api\Transformers\MasterCategoryResource;
use Modules\Api\Transformers\ShopResource;

class MasterCategoryController extends BaseController
{
    /**
     * @var MasterCategoryService
     */
    private $masterCategoryService;

    public function __construct(MasterCategoryService $masterCategoryService)
    {
        $this->masterCategoryService = $masterCategoryService;
    }

    /**
     * List category
     *
     * @OA\Get(
     *      path="/v1/categories",
     *      tags={"MASTER CATEGORY"},
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
     *                              @OA\Items(ref="#/components/schemas/MasterCategoryResource"),
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
     * @return MasterCategoryResource
     */
    public function index(): MasterCategoryResource
    {
        $categories = $this->masterCategoryService->list();

        return MasterCategoryResource::make($categories);
    }
}
