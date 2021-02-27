<?php

namespace Modules\Api\Contracts\Adapters;

use Modules\Api\Entities\User;

interface JWTAuthAdapter
{
    /**
     * Parse token to user.
     *
     * @return User
     */
    public function parseToken();
}
