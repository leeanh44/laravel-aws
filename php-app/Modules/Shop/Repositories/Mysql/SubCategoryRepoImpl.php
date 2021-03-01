<?php

namespace Modules\Shop\Repositories\Mysql;

use Modules\Shop\Entities\SubCategory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Shop\Contracts\Repositories\Mysql\SubCategoryRepository;

class SubCategoryRepoImpl implements SubCategoryRepository
{
    /**
     * List
     *
     * @param integer $categoryId
     * @return LengthAwarePaginator
     */
    public function list(int $categoryId) : LengthAwarePaginator
    {
        return SubCategory::query()
            ->with('media')
            ->where('category_id', $categoryId)
            ->orderByDesc('order')
            ->paginate();
    }

    /**
     * Find max order
     *
     * @param integer $categoryId
     * @return int|null
     */
    public function findMaxOrder(int $categoryId) : ?int
    {
        return SubCategory::query()
            ->where('category_id', $categoryId)
            ->max('order');
    }

    /**
     * Find data
     *
     * @return SubCategory|null
     */
    public function findById(int $id) : ?SubCategory
    {
        return SubCategory::query()
            ->with('media')
            ->find($id);
    }

    /**
     * Create data
     *
     * @return SubCategory|null
     */
    public function create(array $data) : ?SubCategory
    {
        return SubCategory::create($data);
    }

    /**
     * Update data
     *
     * @param array $data
     * @param int $id
     *
     * @return bool
     */
    public function update(array $data, int $id): bool
    {
        return SubCategory::query()
            ->find($id)
            ->update($data);
    }
    
    /**
     * Update order
     *
     * @param integer $categoryId
     * @param integer $newOrder
     * @param integer $oldOrder
     * @return int
     */
    public function updateDisplayOrder(int $categoryId, int $newOrder, int $oldOrder = null): int
    {
        if (!$oldOrder) {
            return SubCategory::where([
                ['category_id', '=', $categoryId],
                ['order', '>=', $newOrder]
            ])->increment('order');
        }

        if ($oldOrder > $newOrder) {
            return SubCategory::where([
                ['category_id', '=', $categoryId],
                ['order', '>=', $newOrder],
                ['order', '<', $oldOrder]
            ])->increment('order');
        }

        return SubCategory::where([
            ['category_id', '=', $categoryId],
            ['order', '>', $oldOrder],
            ['order', '<=', $newOrder]
        ])->decrement('order');
    }
}
