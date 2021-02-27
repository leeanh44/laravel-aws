<?php

namespace Modules\Api\Transformers;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *      properties={
 *          @OA\Property(property="id", type="integer", example=1),
 *          @OA\Property(property="shop_id", type="integer", example=1),
 *          @OA\Property(property="title", type="string", example="Title"),
 *          @OA\Property(property="description", type="string", example="Body content"),
 *          @OA\Property(property="status", type="string", example="ACTIVE"),
 *          @OA\Property(property="created_at", type="string", example="2021-02-04T16:26:33.000000Z"),
 *          @OA\Property(property="update_at", type="string", example="2021-02-04T16:26:33.000000Z"),
 *          @OA\Property(property="img_url", type="string", example="https://coco.vn/images/test.png"),
 *      }
 * )
 */
class NotificationResource extends SuccessResource
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
