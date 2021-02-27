<?php

namespace Modules\Api\Contracts\Services;

use Modules\Api\Entities\UserDevice;

interface UserService
{
    /**
     * Update data.
     *
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function update(array $data, int $id): bool;

    /**
     * Update device.
     *
     * @param array $attributes
     * @param array $data
     * @return UserDevice
     */
    public function updateDevice(array $attributes, array $data): UserDevice;
}
