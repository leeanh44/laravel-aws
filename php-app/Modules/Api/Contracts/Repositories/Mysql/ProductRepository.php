<?php

namespace Modules\Api\Contracts\Repositories\Mysql;

use Modules\Api\Entities\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ProductRepository
{
    /**
     * List product by sub category.
     *
     * @param integer $subCategoryId
     * @return LengthAwarePaginator
     */
    public function listBySubCategory(int $subCategoryId): LengthAwarePaginator;

    /**
     * Find by id.
     *
     * @param integer $id
     * @return Product|null
     */
    public function findById(int $id): ?Product;
}
