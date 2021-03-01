<?php

namespace Modules\Api\Contracts\Repositories\Mysql;

use Modules\Api\Entities\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryRepository
{
    /**
     * Get all categories by shop
     *
     * @param integer $shopId
     * @return Collection|null
     */
    public function findByShopAndStatusActive(int $shopId) : ?Collection;
}
