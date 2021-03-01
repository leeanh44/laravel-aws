<?php

namespace Modules\Admin\Services;

use Modules\Admin\Entities\Shop;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Admin\Contracts\Services\ShopService;
use Modules\Admin\Contracts\Repositories\Mysql\ShopRepository;

class ShopServiceImpl implements ShopService
{
    /** @var ShopRepository */
    private $shopRepository;

    public function __construct(
        ShopRepository $shopRepository
    ) {
        $this->shopRepository = $shopRepository;
    }

    /**
     * Find max order
     *
     * @param array $filter
     * @return LengthAwarePaginator
     */
    public function list(array $filter) : LengthAwarePaginator
    {
        return $this->shopRepository->list($filter);
    }

    /**
     * Find
     *
     * @return Shop|null
     */
    public function findById(int $id) : ?Shop
    {
        return $this->shopRepository->findById($id);
    }

    /**
     * Create data
     *
     * @param array $data
     *
     * @return Shop
     */
    public function create(array $data): Shop
    {
        return $this->shopRepository->create($data);
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
        return $this->shopRepository->update($data, $id);
    }
}
