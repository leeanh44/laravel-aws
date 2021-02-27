<?php

namespace Modules\Shop\Repositories\Mysql;

use Modules\Shop\Entities\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Shop\Contracts\Repositories\Mysql\CategoryRepository;

class CategoryRepoImpl implements CategoryRepository
{
    /**
     * List
     *
     * @return LengthAwarePaginator
     */
    public function list() : LengthAwarePaginator
    {
        return Category::query()
            ->where('shop_id', auth()->user()->shop_id)
            ->orderByDesc('order')
            ->paginate();
    }

    /**
     * Find max order
     *
     * @return int|null
     */
    public function findMaxOrder() : ?int
    {
        return Category::query()
            ->where('shop_id', auth()->user()->shop_id)
            ->max('order');
    }

    /**
     * Find data
     *
     * @return Category|null
     */
    public function findById(int $id) : ?Category
    {
        return Category::query()
            ->where('shop_id', auth()->user()->shop_id)
            ->find($id);
    }

    /**
     * Create data
     *
     * @return Category|null
     */
    public function create(array $data) : ?Category
    {
        return Category::create($data);
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
        return Category::query()
            ->find($id)
            ->update($data);
    }
    
    /**
     * Update order
     *
     * @param integer $newOrder
     * @param integer $oldOrder
     * @return int
     */
    public function updateDisplayOrder(int $newOrder, int $oldOrder = null): int
    {
        if (!$oldOrder) {
            return Category::where([
                ['shop_id', '=', auth()->user()->shop_id],
                ['order', '>=', $newOrder]
            ])->increment('order');
        }

        if ($oldOrder > $newOrder) {
            return Category::where([
                ['shop_id', '=', auth()->user()->shop_id],
                ['order', '>=', $newOrder],
                ['order', '<', $oldOrder]
            ])->increment('order');
        }

        return Category::where([
            ['shop_id', '=', auth()->user()->shop_id],
            ['order', '>', $oldOrder],
            ['order', '<=', $newOrder]
        ])->decrement('order');
    }
}
