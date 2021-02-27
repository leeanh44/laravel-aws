<?php

namespace Modules\Api\Services;

use Modules\Api\Entities\Product;
use Modules\Api\Contracts\Clients\StorageClient;
use Modules\Api\Contracts\Services\ProductService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Api\Contracts\Repositories\Mysql\ProductRepository;

class ProductServiceImpl implements ProductService
{
    /** @var ProductRepository */
    private $productRepository;

    /** @var StorageClient */
    private $storageClient;

    public function __construct(
        StorageClient $storageClient,
        ProductRepository $productRepository
    ) {
        $this->storageClient = $storageClient;
        $this->productRepository = $productRepository;
    }

    /**
     * List product by sub category.
     *
     * @param integer $subCategoryId
     * @return LengthAwarePaginator
     */
    public function listBySubCategory(int $subCategoryId): LengthAwarePaginator
    {
        $products = $this->productRepository->listBySubCategory($subCategoryId);
        $products->transform(function ($product) {
            $product->thumbnail_url = null;
            if ($product->thumbnail) {
                $product->thumbnail_url = $this->storageClient
                    ->getImageUrl($product->thumbnail->media->path, $product->thumbnail->media->name);
            }
            return $product;
        });
        return $products;
    }

    /**
     * Find by id.
     *
     * @param integer $id
     * @return Product|null
     */
    public function findById(int $id): ?Product
    {
        $product = $this->productRepository->findById($id);
        if ($product) {
            $product->images->transform(function ($image) {
                $image->img_url = null;
                if ($image->media) {
                    $image->img_url = $this->storageClient
                        ->getImageUrl($image->media->path, $image->media->name);
                }
                return $image;
            });
        }
        return $product;
    }
}
