<?php

namespace Modules\Api\Repositories\Mysql;

use Modules\Api\Entities\Product;
use Modules\Api\Constants\ProductStatus;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Api\Contracts\Repositories\Mysql\ProductRepository;

class ProductRepoImpl implements ProductRepository
{
    /**
     * List product by sub category.
     *
     * @param integer $subCategoryId
     * @return LengthAwarePaginator
     */
    public function listBySubCategory(int $subCategoryId): LengthAwarePaginator
    {
        return Product::query()
            ->with('thumbnail', 'thumbnail.media')
            ->where([
                'sub_category_id' => $subCategoryId,
                'status' => ProductStatus::ACTIVE
            ])->paginate();
    }

    /**
     * Find by id.
     *
     * @param integer $id
     * @return Product|null
     */
    public function findById(int $id): ?Product
    {
        return Product::query()
            ->with('images', 'images.media')
            ->find($id);
    }
}
