<?php

namespace Modules\Admin\Contracts\Services;

use Modules\Admin\Entities\Shop;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ShopService
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
