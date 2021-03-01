<?php

namespace Modules\Api\Http\Controllers\V1;

use Modules\Api\Http\Controllers\BaseController;
use Modules\Api\Transformers\NotificationResource;
use Modules\Api\Transformers\SuccessPaginationResource;
use Modules\Api\Contracts\Services\NotificationService;

class NotificationController extends BaseController
{
    /**
     * @var NotificationService
     */
    private $notificationService;

    public function __construct(
        NotificationService $notificationService
    ) {
        $this->notificationService = $notificationService;
    }

    /**
     * List notification by shop
     *
     * @OA\Get(
     *      path="/v1/shop/{id}/notifications",
     *      tags={"NOTIFICATION"},
     *      @OA\Parameter(
     *          name="id",
     *          description="Shop id",
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
     *                              @OA\Items(ref="#/components/schemas/NotificationResource"),
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
     * @param integer $shopId
     * @return SuccessPaginationResource
     */
    public function index(int $shopId): SuccessPaginationResource
    {
        $notifications = $this->notificationService->list($shopId);

        return SuccessPaginationResource::make($notifications);
    }

    /**
     * Notification detail
     *
     * @OA\Get(
     *      path="/v1/notification/{id}",
     *      tags={"NOTIFICATION"},
     *      @OA\Parameter(
     *          name="id",
     *          description="Notification id",
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
     *                              type="object",
     *                              ref="#/components/schemas/NotificationResource",
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
     *     ),
     *     security={
     *         {"BearerAuth": {}}
     *     }
     * )
     * @param integer $id
     * @return NotificationResource
     */
    public function detail(int $id) : NotificationResource
    {
        $notification = $this->notificationService->findById($id);

        return NotificationResource::make($notification);
    }
}
