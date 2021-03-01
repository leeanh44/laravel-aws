<?php

namespace Modules\Shop\Services;

use Modules\Shop\Entities\SubCategory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Shop\Contracts\Services\SubCategoryService;
use Modules\Shop\Contracts\Repositories\Mysql\SubCategoryRepository;

class SubCategoryServiceImpl implements SubCategoryService
{
    /** @var SubCategoryRepository */
    private $subCategoryRepository;

    public function __construct(
        SubCategoryRepository $subCategoryRepository
    ) {
        $this->subCategoryRepository = $subCategoryRepository;
    }

    /**
     * List
     *
     * @param integer $categoryId
     * @return LengthAwarePaginator
     */
    public function list(int $categoryId) : LengthAwarePaginator
    {
        return $this->subCategoryRepository->list($categoryId);
    }

    /**
     * Find max order
     *
     * @param integer $categoryId
     * @return int|null
     */
    public function findMaxOrder(int $categoryId) : ?int
    {
        return $this->subCategoryRepository->findMaxOrder($categoryId);
    }

    /**
     * Find
     *
     * @return SubCategory|null
     */
    public function findById(int $id) : ?SubCategory
    {
        return $this->subCategoryRepository->findById($id);
    }

    /**
     * Create data
     *
     * @param array $data
     *
     * @return SubCategory
     */
    public function create(array $data): SubCategory
    {
        return $this->subCategoryRepository->create($data);
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
        return $this->subCategoryRepository->update($data, $id);
    }

    /**
     * Update order
     *
     * @param integer $categoryId
     * @param integer $newOrder
     * @param integer $oldOrder
     * @return int
     */
    public function updateDisplayOrder(int $categoryId, int $newOrder, int $oldOrder = null): int
    {
        return $this->subCategoryRepository->updateDisplayOrder($categoryId, $newOrder, $oldOrder);
    }
}
