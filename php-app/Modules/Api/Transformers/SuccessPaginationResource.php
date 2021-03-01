<?php

namespace Modules\Api\Transformers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @OA\Schema(
 *      properties={
 *          @OA\Property(property="total", type="integer", example=105),
 *          @OA\Property(property="count", type="integer", example=15),
 *          @OA\Property(property="per_page", type="integer", example=15),
 *          @OA\Property(property="current_page", type="integer", example=1),
 *          @OA\Property(
 *              property="next", type="string",
 *              example="https://coco.vn/api/v1/resource?page=3"),
 *          @OA\Property(
 *              property="previous", type="string",
 *              example="https://coco.vn/api/v1/resource?page=1"),
 *          @OA\Property(
 *              property="path", type="string",
 *              example="https://coco.vn/api/v1/resource")
 *      }
 * )
 */
class SuccessPaginationResource extends Resource
{
    /**
     * SuccessPaginationResource constructor.
     * @param null $resource
     * @param int $code
     * @param string $message
     */
    public function __construct($resource, $code = 200, $message = "Successful")
    {
        parent::__construct($resource, new MetaPaginationResource($code, $message));
    }

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'data' => $this->resource->items(),
            'meta' => [
                'pagination' => $this->getMetaPagination($this->resource)
            ]
        ];
    }

    /**
     * Get data pagination.
     *
     * @param LengthAwarePaginator $resource
     * @return array
     */
    private function getMetaPagination(LengthAwarePaginator $resource): array
    {
        return [
            'total'        => $resource->total(),
            'count'        => $resource->count(),
            'per_page'     => $resource->perPage(),
            'current_page' => $resource->currentPage(),
            'next'         => $resource->nextPageUrl(),
            'previous'     => $resource->previousPageUrl(),
            'path'         => $resource->path(),
        ];
    }
}
