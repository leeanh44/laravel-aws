<?php

namespace Modules\Api\Services;

use Modules\Api\Entities\Notification;
use Modules\Api\Contracts\Clients\StorageClient;
use Modules\Api\Contracts\Services\NotificationService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Api\Contracts\Repositories\Mysql\NotificationRepository;

class NotificationServiceImpl implements NotificationService
{
    /** @var NotificationRepository */
    private $notificationRepository;

    /** @var StorageClient */
    private $storageClient;

    public function __construct(
        NotificationRepository $notificationRepository,
        StorageClient $storageClient
    ) {
        $this->notificationRepository = $notificationRepository;
        $this->storageClient = $storageClient;
    }

    /**
     * Get list notification by shop
     *
     * @param integer $shopId
     * @return LengthAwarePaginator|null
     */
    public function list(int $shopId) : ?LengthAwarePaginator
    {
        $notifications = $this->notificationRepository->findByShopAndStatusActive($shopId);
        $notifications->transform(function ($notification) {
            $notification->img_url = null;
            if ($notification->media) {
                $notification->img_url = $this->storageClient
                    ->getImageUrl($notification->media->path, $notification->media->name);
            }

            return $notification;
        });

        return $notifications;
    }

    /**
     * Get detail
     *
     * @param integer $id
     * @return Notification|null
     */
    public function findById(int $id): ?Notification
    {
        $notification = $this->notificationRepository->findById($id);
        if ($notification) {
            $notification->img_url = null;
            if ($notification->media) {
                $notification->img_url = $this->storageClient
                    ->getImageUrl($notification->media->path, $notification->media->name);
            }
        }

        return $notification;
    }
}
