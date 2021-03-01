<?php

namespace Modules\Shop\Repositories\Mysql;

use Carbon\Carbon;
use Modules\Shop\Entities\ShopUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Shop\Contracts\Repositories\Mysql\UserRepository;

class UserRepoImpl implements UserRepository
{
    /**
     * List
     *
     * @param array $filter
     * @return LengthAwarePaginator
     */
    public function list(array $filter) : LengthAwarePaginator
    {

        $query = ShopUser::query()
            ->with('userProfile')
            ->where('shop_id', auth()->user()->id);

        if (isset($filter['id'])) {
            $query = $query->where('id', $filter['id']);
        }
        if (isset($filter['name'])) {
            $query = $query->whereHas('userProfile', function (Builder $query) use ($filter) {
                $query->where('name', 'like', "%{$filter['name']}%");
            });
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
}
