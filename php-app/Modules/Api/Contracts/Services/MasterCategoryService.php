<?php

namespace Modules\Api\Contracts\Services;

use Illuminate\Database\Eloquent\Collection;

interface MasterCategoryService
{
    /**
     * Get list master categories
     *
     * @return Collection|null
     */
    public function list() : ?Collection;
}
