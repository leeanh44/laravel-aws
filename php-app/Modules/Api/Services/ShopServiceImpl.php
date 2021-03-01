<?php

namespace Modules\Api\Services;

use Modules\Api\Entities\Shop;
use Modules\Api\Contracts\Services\ShopService;
use Modules\Api\Contracts\Clients\StorageClient;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Api\Contracts\Repositories\Mysql\ShopRepository;
use Modules\Api\Contracts\Repositories\Mysql\ShopMasterCategoryRepository;

class ShopServiceImpl implements ShopService
{
    /** @var ShopRepository */
    private $shopRepository;

    /** @var ShopMasterCategoryRepository */
    private $shopMasterCategoryRepository;

    /** @var StorageClient */
    private $storageClient;

    public function __construct(
        StorageClient $storageClient,
        ShopRepository $shopRepository,
        ShopMasterCategoryRepository $shopMasterCategoryRepository
    ) {
        $this->storageClient = $storageClient;
        $this->shopRepository = $shopRepository;
        $this->shopMasterCategoryRepository = $shopMasterCategoryRepository;
    }

    /**
     * Get shop detail
     *
     * @param integer $shopId
     * @return Shop|null
     */
    public function findById(int $shopId): ?Shop
    {
        $shop = $this->shopRepository->findById($shopId);
        if ($shop) {
            $shop->img_url = null;
            if ($shop->media) {
                $shop->img_url = $this->storageClient
                    ->getImageUrl($shop->media->path, $shop->media->name);
            }
            $shop->banners->transform(function ($banner) {
                $banner->img_url = null;
                if ($banner->media) {
                    $banner->img_url = $this->storageClient
                        ->getImageUrl($banner->media->path, $banner->media->name);
                }

                return $banner;
            });
        }

        return $shop;
    }

    /**
     * Get shop by master category.
     *
     * @param integer $masterCategoryId
     * @return LengthAwarePaginator
     */
    public function listShopByMasterCategory(int $masterCategoryId): LengthAwarePaginator
    {
        $shopMasterCategories = $this->shopMasterCategoryRepository->findByMasterCategory($masterCategoryId);
        $shopMasterCategories->transform(function ($shopMasterCategory) {
            $shopMasterCategory->shop->img_url = null;
            if ($shopMasterCategory->shop->media) {
                $shopMasterCategory->shop->img_url = $this->storageClient
                    ->getImageUrl($shopMasterCategory->shop->media->path, $shopMasterCategory->shop->media->name);
            }
            return $shopMasterCategory->shop;
        });
        return $shopMasterCategories;
    }
}
