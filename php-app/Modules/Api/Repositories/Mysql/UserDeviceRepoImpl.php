<?php

namespace Modules\Api\Repositories\Mysql;

use Modules\Api\Contracts\Repositories\Mysql\UserDeviceRepository;
use Modules\Api\Entities\UserDevice;

class UserDeviceRepoImpl implements UserDeviceRepository
{
    /**
     * Update or create user device.
     *
     * @param array $attributes
     * @param array $data
     * @return UserDevice
     */
    public function updateOrCreate(array $attributes, array $data) : UserDevice
    {
        return UserDevice::updateOrCreate($attributes, $data);
    }
}
