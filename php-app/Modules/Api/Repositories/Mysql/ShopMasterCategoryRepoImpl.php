<?php

namespace Modules\Api\Repositories\Mysql;

use Modules\Api\Constants\ShopStatus;
use Modules\Api\Entities\ShopMasterCategory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Api\Contracts\Repositories\Mysql\ShopMasterCategoryRepository;

class ShopMasterCategoryRepoImpl implements ShopMasterCategoryRepository
{
    /**
     * Get list shop by category
     *
     * @param integer $id
     * @return LengthAwarePaginator
     */
    public function findByMasterCategory(int $id) : LengthAwarePaginator
    {
        return ShopMasterCategory::query()
            ->whereHas('shop', function ($query) {
                $query->where('status', ShopStatus::ACTIVE);
            })
            ->with('shop', 'shop.media')
            ->where('master_category_id', $id)
            ->paginate();
    }
}
