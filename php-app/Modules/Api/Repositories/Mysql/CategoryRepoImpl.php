<?php

namespace Modules\Api\Repositories\Mysql;

use Modules\Api\Constants\CategoryStatus;
use Modules\Api\Entities\Category;
use Illuminate\Database\Eloquent\Collection;
use Modules\Api\Contracts\Repositories\Mysql\CategoryRepository;

class CategoryRepoImpl implements CategoryRepository
{
    /**
     * Get list by shop
     *
     * @param integer $shopId
     * @return Collection|null
     */
    public function findByShopAndStatusActive(int $shopId) : ?Collection
    {
        return Category::query()
            ->with('subCategories', 'subCategories.media')
            ->where([
                'shop_id' => $shopId,
                'status' => CategoryStatus::ACTIVE
            ])
            ->orderBy('order')
            ->get();
    }
}
