<?php

namespace Modules\Api\Contracts\Services;

use Modules\Api\Repositories\Auth;
use Modules\Api\Entities\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryService
{
    /**
     * Get list of categories by shop
     *
     * @param integer $shopId
     * @return Collection|null
     */
    public function list(int $shopId) : ?Collection;
}
