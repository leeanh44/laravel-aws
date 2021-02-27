<?php

namespace Modules\Admin\Contracts\Services;

use Modules\Admin\Entities\MasterCategory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface MasterCategoryService
{
    /**
     * All
     *
     * @return Collection
     */
    public function all() : Collection;

    /**
     * List
     *
     * @return LengthAwarePaginator
     */
    public function list() : LengthAwarePaginator;

    /**
     * Find
     *
     * @return MasterCategory|null
     */
    public function findById(int $id) : ?MasterCategory;

    /**
     * Find max order
     *
     * @return int|null
     */
    public function findMaxOrder() : ?int;

    /**
     * Create data
     *
     * @param array $data
     * @return MasterCategory|null
     */
    public function create(array $data) : ?MasterCategory;

    /**
     * Update data
     *
     * @param array $data
     * @param integer $id
     * @return bool
     */
    public function update(array $data, int $id) : bool;

    /**
     * Update order
     *
     * @param integer $newOrder
     * @param integer $oldOrder
     * @return int
     */
    public function updateDisplayOrder(int $newOrder, int $oldOrder = null) : int;
}
