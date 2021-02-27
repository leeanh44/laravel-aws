<?php

namespace Modules\Api\Contracts\Services;

use Modules\Api\Entities\ShopUser;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ShopUserService
{
    /**
     * Update or create shop user.
     *
     * @param array $attributes
     * @param array $data
     * @return ShopUser
     */
    public function updateOrCreate(array $attributes, array $data) : ShopUser;

    /**
     * Find shop user.
     *
     * @param integer $shopId
     * @param integer $userId
     * @return ShopUser|null
     */
    public function findShopUser(int $shopId, int $userId) : ?ShopUser;

    /**
     * List shop by user.
     *
     * @param integer $userId
     * @return LengthAwarePaginator
     */
    public function listByUser(int $userId): LengthAwarePaginator;
}
