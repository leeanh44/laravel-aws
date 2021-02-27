<?php

namespace Modules\Api\Repositories\Mysql;

use Modules\Api\Entities\Notification;
use Modules\Api\Constants\NotificationStatus;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Api\Contracts\Repositories\Mysql\NotificationRepository;

class NotificationRepoImpl implements NotificationRepository
{

    /**
     * Get list notification by shop
     *
     * @param integer $shopId
     * @return LengthAwarePaginator|null
     */
    public function findByShopAndStatusActive(int $shopId) : ?LengthAwarePaginator
    {
        return Notification::query()
            ->with('media')
            ->where([
                'shop_id' => $shopId,
                'status' => NotificationStatus::ACTIVE
            ])
            ->orderBy('created_at')
            ->paginate();
    }

    /**
     * Get detail
     *
     * @param integer $id
     * @return Notification|null
     */
    public function findById(int $id) : ?Notification
    {
        return Notification::query()
            ->with('media')
            ->find($id);
    }
}
