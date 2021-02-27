<?php

namespace Modules\Api\Repositories\Mysql;

use Modules\Api\Entities\ShopUser;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Api\Contracts\Repositories\Mysql\ShopUserRepository;

class ShopUserRepoImpl implements ShopUserRepository
{
    /**
     * List shop by user.
     *
     * @param integer $userId
     * @return LengthAwarePaginator
     */
    public function listByUser(int $userId): LengthAwarePaginator
    {
        return ShopUser::query()
            ->with('shopProfile', 'shopProfile.media')
            ->where('user_id', $userId)
            ->paginate();
    }

    /**
     * Update or create shop user.
     *
     * @param array $attributes
     * @param array $data
     * @return ShopUser
     */
    public function updateOrCreate(array $attributes, array $data) : ShopUser
    {
        return ShopUser::updateOrCreate($attributes, $data);
    }

    /**
     * Find shop user.
     *
     * @param integer $shopId
     * @param integer $userId
     * @return ShopUser|null
     */
    public function findShopUser(int $shopId, int $userId) : ?ShopUser
    {
        return ShopUser::query()
            ->with('shopProfile', 'shopProfile.media')
            ->where([
                'shop_id' => $shopId,
                'user_id' => $userId
            ])->first();
    }
}
