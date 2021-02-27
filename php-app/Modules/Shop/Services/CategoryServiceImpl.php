<?php

namespace Modules\Shop\Services;

use Modules\Shop\Entities\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Shop\Contracts\Services\CategoryService;
use Modules\Shop\Contracts\Repositories\Mysql\CategoryRepository;

class CategoryServiceImpl implements CategoryService
{
    /** @var CategoryRepository */
    private $categoryRepository;

    public function __construct(
        CategoryRepository $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Find max order
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
     * @return Category|null
     */
    public function findById(int $id) : ?Category
    {
        return $this->categoryRepository->findById($id);
    }

    /**
     * Create data
     *
     * @param array $data
     *
     * @return Category
     */
    public function create(array $data): Category
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
