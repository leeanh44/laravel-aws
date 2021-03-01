<?php

namespace Modules\Api\Contracts\Repositories\Mysql;

use Modules\Api\Entities\UserDevice;

interface UserDeviceRepository
{
    /**
     * Update or create user device.
     *
     * @param array $attributes
     * @param array $data
     * @return UserDevice
     */
    public function updateOrCreate(array $attributes, array $data) : UserDevice;
}
