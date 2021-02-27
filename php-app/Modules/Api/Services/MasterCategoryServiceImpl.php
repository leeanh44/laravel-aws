<?php

namespace Modules\Api\Services;

use Modules\Api\Contracts\Clients\StorageClient;
use Illuminate\Database\Eloquent\Collection;
use Modules\Api\Contracts\Services\MasterCategoryService;
use Modules\Api\Contracts\Repositories\Mysql\MasterCategoryRepository;

class MasterCategoryServiceImpl implements MasterCategoryService
{
    /** @var MasterCategoryRepository */
    private $masterCategoryRepository;

    /** @var StorageClient */
    private $storageClient;

    public function __construct(
        MasterCategoryRepository $masterCategoryRepository,
        StorageClient $storageClient
    ) {
        $this->masterCategoryRepository = $masterCategoryRepository;
        $this->storageClient = $storageClient;
    }

    /**
     * Get list master categories
     *
     * @return Collection|null
     */
    public function list() : ?Collection
    {
        $categories = $this->masterCategoryRepository->findAllStatusActive();
        $categories->transform(function ($category) {
            $category->img_url = null;
            if ($category->media) {
                $category->img_url = $this->storageClient
                    ->getImageUrl($category->media->path, $category->media->name);
            }
            return $category;
        });
        return $categories;
    }
}
