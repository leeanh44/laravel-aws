<?php

namespace Modules\Shop\Contracts\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserService
{
    /**
     * List
     *
     * @param array $filter
     * @return LengthAwarePaginator
     */
    public function list(array $filter) : LengthAwarePaginator;
}
