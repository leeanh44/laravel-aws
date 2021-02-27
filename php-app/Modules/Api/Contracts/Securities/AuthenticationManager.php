<?php

namespace Modules\Api\Contracts\Securities;

interface AuthenticationManager
{
    public function authenticate(Authentication $auth): Authentication;
}
