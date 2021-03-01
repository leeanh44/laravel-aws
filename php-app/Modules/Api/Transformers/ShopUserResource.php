<?php

namespace Modules\Api\Transformers;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *      properties={
 *          @OA\Property(property="id", type="integer", example=1),
 *          @OA\Property(property="shop_id", type="integer", example=12),
 *          @OA\Property(property="user_id", type="integer", example=10),
 *          @OA\Property(property="level", type="integer", example=0),
 *          @OA\Property(property="point_total", type="integer", example=200),
 *          @OA\Property(property="status", type="string", example="ACTIVE"),
 *          @OA\Property(
 *              property="shop_profile",
 *              type="array",
 *              @OA\Items(
 *                  type="object",
 *                  ref="#/components/schemas/ShopResource"
 *              ),
 *          )
 *      }
 * )
 */
class ShopUserResource extends SuccessResource
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
