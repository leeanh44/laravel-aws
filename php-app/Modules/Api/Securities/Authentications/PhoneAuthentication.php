<?php

namespace Modules\Api\Securities\Authentications;

use Modules\Api\Contracts\Securities\Authentication;
use Modules\Api\Repositories\Auth;

class PhoneAuthentication implements Authentication
{

    /** @var object|string */
    private $guards;

    /** @var PhoneAuthenticationCredentials */
    private $credentials;

    /** @var object */
    private $userDetails;

    /** @var Auth */
    private $authenticatedCertificates;

    public function __construct(string $guards, string $phone)
    {
        $this->guards = $guards;
        $this->credentials = new PhoneAuthenticationCredentials($phone);
    }

    public function getCredentials()
    {
        return $this->credentials;
    }

    public function setUserDetails($user): void
    {
        $this->userDetails = $user;
    }

    public function getUserDetails()
    {
        return $this->userDetails;
    }

    public function setAuthenticatedCertificates(Auth $authenticatedCertificates): void
    {
        $this->authenticatedCertificates = $authenticatedCertificates;
    }

    public function getAuthenticatedCertificates()
    {
        return $this->authenticatedCertificates;
    }

    public function getGuards()
    {
        return $this->guards;
    }
}
