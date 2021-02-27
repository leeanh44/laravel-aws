<?php

namespace Modules\Admin\Repositories\Mysql;

use Modules\Admin\Entities\MasterCategory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Admin\Contracts\Repositories\Mysql\MasterCategoryRepository;

class MasterCategoryRepoImpl implements MasterCategoryRepository
{
    /**
     * List all
     *
     * @return Collection
     */
    public function all() : Collection
    {
        return MasterCategory::query()
            ->orderByDesc('order')
            ->get();
    }

    /**
     * List
     *
     * @return LengthAwarePaginator
     */
    public function list() : LengthAwarePaginator
    {
        return MasterCategory::query()
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
        return MasterCategory::query()
            ->max('order');
    }

    /**
     * Find data
     *
     * @return MasterCategory|null
     */
    public function findById(int $id) : ?MasterCategory
    {
        return MasterCategory::query()
            ->with('media')
            ->find($id);
    }

    /**
     * Create data
     *
     * @return MasterCategory|null
     */
    public function create(array $data) : ?MasterCategory
    {
        return MasterCategory::create($data);
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
        return MasterCategory::query()
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
            return MasterCategory::where([
                ['order', '>=', $newOrder]
            ])->increment('order');
        }

        if ($oldOrder > $newOrder) {
            return MasterCategory::where([
                ['order', '>=', $newOrder],
                ['order', '<', $oldOrder]
            ])->increment('order');
        }

        return MasterCategory::where([
            ['order', '>', $oldOrder],
            ['order', '<=', $newOrder]
        ])->decrement('order');
    }
}
