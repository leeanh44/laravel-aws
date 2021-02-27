<?php

namespace Modules\Api\Transformers;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *      properties={
 *          @OA\Property(property="id", type="integer", example=1),
 *          @OA\Property(property="name", type="string", example="Hot teas"),
 *          @OA\Property(property="order", type="integer", example=1),
 *          @OA\Property(property="status", type="string", example="ACTIVE"),
 *          @OA\Property(property="img_url", type="string", example="https://coco.vn/images/test.png"),
 *      }
 * )
 */
class SubCategoryResource extends SuccessResource
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
