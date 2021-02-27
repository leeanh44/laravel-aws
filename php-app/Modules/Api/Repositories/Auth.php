<?php

namespace Modules\Api\Repositories;

use Modules\Api\Constants\AuthAccountStatus;

class Auth
{
    /** @var string */
    public $token;

    /** @var string */
    public $accountStatus;

    /**
     * AuthModel constructor.
     *
     * @param string $token
     * @return void
     */
    public function __construct(string $token, string $accountStatus = AuthAccountStatus::OLD_ACCOUNT)
    {
        $this->token = $token;
        $this->accountStatus = $accountStatus;
    }

    public function toArray(): array
    {
        return [
            'token' => $this->token,
            'account_status' => $this->accountStatus
        ];
    }
}
