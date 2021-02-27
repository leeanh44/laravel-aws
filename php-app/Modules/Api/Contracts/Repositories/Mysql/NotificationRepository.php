<?php

namespace Modules\Api\Contracts\Repositories\Mysql;

use Modules\Api\Entities\Notification;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface NotificationRepository
{
    /**
     * Get list notification by shop
     *
     * @param integer $shopId
     * @return LengthAwarePaginator|null
     */
    public function findByShopAndStatusActive(int $shopId) : ?LengthAwarePaginator;

    /**
     * Get detail
     *
     * @param integer $id
     * @return Notification|null
     */
    public function findById(int $id) : ?Notification;
}
