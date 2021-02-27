<?php

namespace Modules\Admin\Repositories\Mysql;

use Carbon\Carbon;
use Modules\Admin\Entities\Shop;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Admin\Contracts\Repositories\Mysql\ShopRepository;

class ShopRepoImpl implements ShopRepository
{
    /**
     * List
     *
     * @param array $filter
     * @return LengthAwarePaginator
     */
    public function list(array $filter) : LengthAwarePaginator
    {
        $query = Shop::query();

        if (isset($filter['id'])) {
            $query = $query->where('id', $filter['id']);
        }
        if (isset($filter['name'])) {
            $query = $query->where('name', 'like', "%{$filter['name']}%");
        }
        if (isset($filter['created_from'])) {
            $query = $query->whereDate(
                'created_at',
                '>=',
                Carbon::createFromFormat('d/m/Y', $filter['created_from'])->format('Y-m-d')
            );
        }
        if (isset($filter['created_to'])) {
            $query = $query->whereDate(
                'created_at',
                '<=',
                Carbon::createFromFormat('d/m/Y', $filter['created_to'])->format('Y-m-d')
            );
        }
        if (isset($filter['status'])) {
            $query = $query->whereIn('status', $filter['status']);
        }
        return $query->orderByDesc('created_at')->paginate();
    }

    /**
     * Find data
     *
     * @return Shop|null
     */
    public function findById(int $id) : ?Shop
    {
        return Shop::query()
            ->with('media')
            ->find($id);
    }

    /**
     * Create data
     *
     * @return Shop|null
     */
    public function create(array $data) : ?Shop
    {
        return Shop::create($data);
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
        return Shop::query()
            ->find($id)
            ->update($data);
    }
}
