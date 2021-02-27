<?php

namespace Modules\Admin\Contracts\Repositories\Mysql;

use Modules\Admin\Entities\Shop;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ShopRepository
{
    /**
     * List
     *
     * @param array $filter
     * @return LengthAwarePaginator
     */
    public function list(array $filter) : LengthAwarePaginator;

    /**
     * Find
     *
     * @return Shop|null
     */
    public function findById(int $id) : ?Shop;

    /**
     * Create data
     *
     * @param array $data
     * @return Shop|null
     */
    public function create(array $data) : ?Shop;

    /**
     * Update data
     *
     * @param array $data
     * @param integer $id
     * @return bool
     */
    public function update(array $data, int $id) : bool;
}
