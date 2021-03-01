<?php

namespace Modules\Api\Contracts\Services;

use Modules\Api\Entities\Notification;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface NotificationService
{
    /**
     * Get list notification by shop
     *
     * @param integer $shopId
     * @return LengthAwarePaginator|null
     */
    public function list(int $shopId) : ?LengthAwarePaginator;

    /**
     * Get detail
     *
     * @param integer $id
     * @return Notification|null
     */
    public function findById(int $id) : ?Notification;
}
