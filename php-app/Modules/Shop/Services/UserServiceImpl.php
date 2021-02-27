<?php

namespace Modules\Shop\Services;

use Modules\Shop\Contracts\Services\UserService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Shop\Contracts\Repositories\Mysql\UserRepository;

class UserServiceImpl implements UserService
{
    /** @var UserRepository */
    private $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * List
     *
     * @param array $filter
     * @return LengthAwarePaginator
     */
    public function list(array $filter) : LengthAwarePaginator
    {
        return $this->userRepository->list($filter);
    }
}
