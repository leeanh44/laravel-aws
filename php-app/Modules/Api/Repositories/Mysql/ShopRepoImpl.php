<?php

namespace Modules\Api\Repositories\Mysql;

use Modules\Api\Entities\Shop;
use Modules\Api\Contracts\Repositories\Mysql\ShopRepository;

class ShopRepoImpl implements ShopRepository
{
    /**
     * Get list by shop
     *
     * @param integer $shopId
     * @return Shop|null
     */
    public function findById(int $shopId) : ?Shop
    {
        return Shop::query()
            ->with('media', 'banners', 'banners.media')
            ->find($shopId);
    }
}
