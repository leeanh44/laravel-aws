<?php

namespace Modules\Api\Repositories\Mysql;

use Modules\Api\Constants\MasterCategoryStatus;
use Modules\Api\Entities\MasterCategory;
use Illuminate\Database\Eloquent\Collection;
use Modules\Api\Contracts\Repositories\Mysql\MasterCategoryRepository;

class MasterCategoryRepoImpl implements MasterCategoryRepository
{
    /**
     * Get list active
     *
     * @return Collection|null
     */
    public function findAllStatusActive() : ?Collection
    {
        return MasterCategory::query()
            ->with('media')
            ->where('status', MasterCategoryStatus::ACTIVE)
            ->orderBy('order')
            ->get();
    }
}
