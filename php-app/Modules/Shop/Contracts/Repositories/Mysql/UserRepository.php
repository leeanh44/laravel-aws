<?php

namespace Modules\Shop\Contracts\Repositories\Mysql;

use Modules\Shop\Entities\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserRepository
{
    /**
     * List
     *
     * @param array $filter
     * @return LengthAwarePaginator
     */
    public function list(array $filter) : LengthAwarePaginator;
}
