<?php

namespace Modules\Api\Securities\Authentications;

class PhoneAuthenticationCredentials
{
    /** @var string  */
    private $phone;

    /**
     * PhoneAuthenticationCredentials constructor.
     * @param string $phone
     */
    public function __construct(string $phone)
    {
        $this->phone = $phone;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }
}
