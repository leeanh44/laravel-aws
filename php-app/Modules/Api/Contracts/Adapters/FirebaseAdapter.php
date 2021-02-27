<?php

namespace Modules\Api\Contracts\Adapters;

interface FirebaseAdapter
{
    /**
     * Send notification
     *
     * @param string $deviceToken
     * @param array $notification
     * @param array $data
     * @return bool
     */
    public function send(string $deviceToken, array $notification, array $data) : bool;
}
