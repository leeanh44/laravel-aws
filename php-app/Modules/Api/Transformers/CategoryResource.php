<?php

namespace Modules\Api\Transformers;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *      properties={
 *          @OA\Property(property="id", type="integer", example=1),
 *          @OA\Property(property="name", type="string", example="Drinks"),
 *          @OA\Property(property="order", type="integer", example=1),
 *          @OA\Property(property="status", type="string", example="ACTIVE"),
 *          @OA\Property(
 *              property="sub_categories",
 *              type="array",
 *              @OA\Items(
 *                  type="object",
 *                  ref="#/components/schemas/SubCategoryResource"
 *              ),
 *          )
 *      }
 * )
 */
class CategoryResource extends SuccessResource
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
