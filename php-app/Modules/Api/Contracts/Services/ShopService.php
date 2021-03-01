<?php

namespace Modules\Api\Contracts\Services;

use Modules\Api\Entities\Shop;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ShopService
{
    /**
     * Get detail shop
     *
     * @param integer $shopId
     * @return Shop|null
     */
    public function findById(int $shopId) : ?Shop;

    /**
     * Get list shop by master category.
     *
     * @param integer $masterCategoryId
     * @return LengthAwarePaginator
     */
    public function listShopByMasterCategory(int $masterCategoryId) : LengthAwarePaginator;
}
