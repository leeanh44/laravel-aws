<?php

namespace Modules\Api\Transformers;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *      properties={
 *          @OA\Property(property="id", type="integer", example=1),
 *          @OA\Property(property="name", type="string", example="The Coffee House"),
 *          @OA\Property(property="address", type="string", example="01 Núi Thành, Phường, Hải Châu, Đà Nẵng 550000"),
 *          @OA\Property(property="working_time", type="string", example="6:00AM - 10:00PM"),
 *          @OA\Property(property="description", type="string", example="Description"),
 *          @OA\Property(property="status", type="string", example="ACTIVE"),
 *          @OA\Property(property="img_url", type="string", example="https://coco.vn/images/test.png"),
 *          @OA\Property(
 *              property="banners",
 *              type="array",
 *              @OA\Items(
 *                  type="object",
 *                  ref="#/components/schemas/ShopBannerResource"
 *              ),
 *          )
 *      }
 * )
 */
class ShopResource extends SuccessResource
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
