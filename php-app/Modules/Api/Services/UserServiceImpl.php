<?php

namespace Modules\Api\Services;

use Modules\Api\Entities\User;
use Modules\Api\Entities\UserDevice;
use Modules\Api\Contracts\Services\UserService;
use Modules\Api\Contracts\Repositories\Mysql\UserRepository;
use Modules\Api\Contracts\Repositories\Mysql\UserDeviceRepository;

class UserServiceImpl implements UserService
{
    /** @var UserRepository */
    private $userRepository;

    /** @var UserDeviceRepository */
    private $userDeviceRepository;

    public function __construct(
        UserRepository $userRepository,
        UserDeviceRepository $userDeviceRepository
    ) {
        $this->userRepository = $userRepository;
        $this->userDeviceRepository = $userDeviceRepository;
    }

    /**
     * Update data.
     *
     * @param array $data
     * @param int $id
     *
     * @return bool
     */
    public function update(array $data, int $id): bool
    {
        return $this->userRepository->update($data, $id);
    }

    /**
     * Update device.
     *
     * @param array $attributes
     * @param array $data
     * @return UserDevice
     */
    public function updateDevice(array $attributes, array $data): UserDevice
    {
        return $this->userDeviceRepository->updateOrCreate($attributes, $data);
    }
}
