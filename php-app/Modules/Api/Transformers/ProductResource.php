<?php

namespace Modules\Api\Transformers;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *      properties={
 *          @OA\Property(property="id", type="integer", example=1),
 *          @OA\Property(property="sub_category_id", type="integer", example=1),
 *          @OA\Property(property="name", type="string", example="Title"),
 *          @OA\Property(property="description", type="string", example="Body content"),
 *          @OA\Property(property="price", type="double", example=10000),
 *          @OA\Property(property="rating", type="integer", example=4),
 *          @OA\Property(property="status", type="string", example="ACTIVE"),
 *          @OA\Property(property="thumbnail_url", type="string", example="https://coco.vn/images/test.png"),
 *          @OA\Property(
 *              property="images",
 *              type="array",
 *              @OA\Items(
 *                  type="object",
 *                  ref="#/components/schemas/ProductImageResource"
 *              ),
 *          )
 *      }
 * )
 */
class ProductResource extends SuccessResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
