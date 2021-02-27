<?php

namespace Modules\Shop\Contracts\Repositories\Mysql;

use Modules\Shop\Entities\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CategoryRepository
{
    /**
     * List
     *
     * @return LengthAwarePaginator
     */
    public function list() : LengthAwarePaginator;

    /**
     * Find
     *
     * @return Category|null
     */
    public function findById(int $id) : ?Category;

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
     * @return Category|null
     */
    public function create(array $data) : ?Category;

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
