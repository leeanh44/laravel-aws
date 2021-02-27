<?php

namespace Modules\Api\Tests\Helpers;

use Modules\Api\Entities\User;
use Tymon\JWTAuth\JWTAuth;

trait UserTokenService
{
    protected function generateToken(?User $user = null): string
    {
        if ($user === null) {
            $user = User::factory()->create();
        }
        $jwtAuth = app(JWTAuth::class);

        return $jwtAuth->fromUser($user);
    }

    protected function headersWithToken(?User $user = null): array
    {
        return [
            'Authorization' => 'Bearer ' . $this->generateToken($user)
        ];
    }
}
