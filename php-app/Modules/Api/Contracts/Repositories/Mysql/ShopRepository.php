<?php

namespace Modules\Api\Contracts\Repositories\Mysql;

use Modules\Api\Entities\Shop;

interface ShopRepository
{
    /**
     * Get shop detail
     *
     * @param integer $shopId
     * @return Shop|null
     */
    public function findById(int $shopId) : ?Shop;
}
