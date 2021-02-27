<?php

namespace Modules\Api\Contracts\Repositories\Mysql;

use Illuminate\Database\Eloquent\Collection;
use Modules\Api\Entities\MasterCategory;

interface MasterCategoryRepository
{
    /**
     * Get all categories
     *
     * @return Collection|null
     */
    public function findAllStatusActive() : ?Collection;
}
