<?php

namespace Modules\Api\Adapters;

use JWTAuth;
use Exception;
use Modules\Api\Entities\User;
use Modules\Api\Contracts\Adapters\JWTAuthAdapter;

class JWTAuthAdapterImpl implements JWTAuthAdapter
{
    /**
     * Parse token to user.
     *
     * @return User|false
     */
    public function parseToken()
    {
        try {
            if (!empty($user = JWTAuth::parseToken()->toUser())) {
                return $user;
            }

            return false;
        } catch (Exception $e) {
            return false;
        }
    }
}
