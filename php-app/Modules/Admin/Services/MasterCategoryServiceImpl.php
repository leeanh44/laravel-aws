<?php

namespace Modules\Admin\Services;

use Modules\Admin\Entities\MasterCategory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Admin\Contracts\Services\MasterCategoryService;
use Modules\Admin\Contracts\Repositories\Mysql\MasterCategoryRepository;

class MasterCategoryServiceImpl implements MasterCategoryService
{
    /** @var MasterCategoryRepository */
    private $categoryRepository;

    public function __construct(
        MasterCategoryRepository $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * All
     *
     * @return Collection
     */
    public function all() : Collection
    {
        return $this->categoryRepository->all();
    }

    /**
     * List
     *
     * @return LengthAwarePaginator
     */
    public function list() : LengthAwarePaginator
    {
        return $this->categoryRepository->list();
    }

    /**
     * Find max order
     *
     * @return int|null
     */
    public function findMaxOrder() : ?int
    {
        return $this->categoryRepository->findMaxOrder();
    }

    /**
     * Find
     *
     * @return MasterCategory|null
     */
    public function findById(int $id) : ?MasterCategory
    {
        return $this->categoryRepository->findById($id);
    }

    /**
     * Create data
     *
     * @param array $data
     *
     * @return MasterCategory
     */
    public function create(array $data): MasterCategory
    {
        return $this->categoryRepository->create($data);
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
        return $this->categoryRepository->update($data, $id);
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
        return $this->categoryRepository->updateDisplayOrder($newOrder, $oldOrder);
    }
}
