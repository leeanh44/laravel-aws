<?php

namespace Modules\Shop\Contracts\Repositories\Mysql;

use Modules\Shop\Entities\SubCategory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface SubCategoryRepository
{
    /**
     * List
     *
     * @param integer $categoryId
     * @return LengthAwarePaginator
     */
    public function list(int $categoryId) : LengthAwarePaginator;

    /**
     * Find
     *
     * @return SubCategory|null
     */
    public function findById(int $id) : ?SubCategory;

    /**
     * Find max order
     *
     * @param integer $categoryId
     * @return int|null
     */
    public function findMaxOrder(int $categoryId) : ?int;

    /**
     * Create data
     *
     * @param array $data
     * @return SubCategory|null
     */
    public function create(array $data) : ?SubCategory;

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
     * @param integer $categoryId
     * @param integer $newOrder
     * @param integer $oldOrder
     * @return int
     */
    public function updateDisplayOrder(int $categoryId, int $newOrder, int $oldOrder = null) : int;
}
