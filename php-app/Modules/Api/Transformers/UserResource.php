<?php

namespace Modules\Api\Transformers;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *      properties={
 *          @OA\Property(property="id", type="integer", example=1),
 *          @OA\Property(property="uuid", type="string", example="1f745ab1-8248-473f-bce2-aa506124b1b0"),
 *          @OA\Property(property="phone", type="string", example="0987654321"),
 *          @OA\Property(property="name", type="string", example="User name"),
 *          @OA\Property(property="email", type="string", example="test@gmail.com"),
 *          @OA\Property(property="status", type="string", example="ACTIVE")
 *      }
 * )
 */
class UserResource extends SuccessResource
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
