<?php

namespace Modules\Api\Contracts\Repositories\Mysql;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ShopMasterCategoryRepository
{
    /**
     * List shop by master category.
     *
     * @param integer $masterCategoryId
     * @return LengthAwarePaginator
     */
    public function findByMasterCategory(int $masterCategoryId): LengthAwarePaginator;
}
