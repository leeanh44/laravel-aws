<?php

namespace Modules\Api\Services;

use Modules\Api\Entities\ShopUser;
use Modules\Api\Contracts\Clients\StorageClient;
use Modules\Api\Contracts\Services\ShopUserService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Api\Contracts\Repositories\Mysql\ShopUserRepository;

class ShopUserServiceImpl implements ShopUserService
{
    /** @var ShopUserRepository */
    private $shopUserRepository;

    /** @var StorageClient */
    private $storageClient;

    public function __construct(
        ShopUserRepository $shopUserRepository,
        StorageClient $storageClient
    ) {
        $this->shopUserRepository = $shopUserRepository;
        $this->storageClient = $storageClient;
    }

    /**
     * List shop by user.
     *
     * @param integer $userId
     * @return LengthAwarePaginator
     */
    public function listByUser(int $userId): LengthAwarePaginator
    {
        $shops = $this->shopUserRepository->listByUser($userId);
        $shops->transform(function ($shop) {
            $shop->shopProfile->img_url = null;
            if ($shop->shopProfile->media) {
                $shop->shopProfile->img_url = $this->storageClient
                    ->getImageUrl($shop->shopProfile->media->path, $shop->shopProfile->media->name);
            }
            return $shop;
        });
        return $shops;
    }

    /**
     * Update or create shop user.
     *
     * @param array $attributes
     * @param array $data
     * @return ShopUser
     */
    public function updateOrCreate(array $attributes, array $data): ShopUser
    {
        return $this->shopUserRepository->updateOrCreate($attributes, $data);
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
        $shop = $this->shopUserRepository->findShopUser($shopId, $userId);
        if ($shop) {
            $shop->shopProfile->img_url = null;
            if ($shop->shopProfile->media) {
                $shop->shopProfile->img_url = $this->storageClient
                    ->getImageUrl($shop->shopProfile->media->path, $shop->shopProfile->media->name);
            }
        }
        return $shop;
    }
}
