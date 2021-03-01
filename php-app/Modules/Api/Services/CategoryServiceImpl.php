<?php

namespace Modules\Api\Services;

use Modules\Api\Contracts\Clients\StorageClient;
use Modules\Api\Entities\Category;
use Illuminate\Database\Eloquent\Collection;
use Modules\Api\Contracts\Services\CategoryService;
use Modules\Api\Contracts\Repositories\Mysql\CategoryRepository;

class CategoryServiceImpl implements CategoryService
{
    /** @var CategoryRepository */
    private $categoryRepository;

    /** @var StorageClient */
    private $storageClient;

    public function __construct(
        CategoryRepository $categoryRepository,
        StorageClient $storageClient
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->storageClient = $storageClient;
    }

    /**
     * Get list of categories by shop
     *
     * @param integer $shopId
     * @return Collection|null
     */
    public function list(int $shopId) : ?Collection
    {
        $categories = $this->categoryRepository->findByShopAndStatusActive($shopId);
        $categories->transform(function ($category) {
            if ($category->subCategories) {
                $category->subCategories->transform(function ($subCategory) {
                    $subCategory->img_url = null;
                    if ($subCategory->media) {
                        $subCategory->img_url = $this->storageClient
                            ->getImageUrl($subCategory->media->path, $subCategory->media->name);
                    }

                    return $subCategory;
                });
            }

            return $category;
        });

        return $categories;
    }
}
