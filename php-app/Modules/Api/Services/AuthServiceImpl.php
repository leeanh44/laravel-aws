<?php

namespace Modules\Api\Services;

use App\Exceptions\ApiException;
use Modules\Api\Constants\UserStatus;
use Modules\Api\Constants\AuthAccountStatus;
use Modules\Api\Contracts\Repositories\Mysql\UserRepository;
use Modules\Api\Contracts\Securities\AuthenticationManager;
use Modules\Api\Contracts\Services\AuthService;
use Modules\Api\Repositories\Auth;
use Modules\Api\Repositories\Parameters\AuthLoginParam;
use Modules\Api\Securities\Authentications\BasicAuthentication;
use Modules\Api\Securities\Authentications\PhoneAuthentication;
use Modules\Api\Entities\User;

class AuthServiceImpl implements AuthService
{
    /** @var AuthenticationManager */
    private $authenticationManager;

    /** @var UserRepository */
    private $userRepository;

    public function __construct(AuthenticationManager $authenticationManager, UserRepository $userRepository)
    {
        $this->authenticationManager = $authenticationManager;
        $this->userRepository = $userRepository;
    }

    /**
     * Login service
     *
     * @param AuthLoginParam $param
     * @return Auth
     */
    public function login(AuthLoginParam $param): Auth
    {
        $basicAuth = new BasicAuthentication("api", $param->email, $param->password);
        $authenticatedObject = $this->authenticationManager->authenticate($basicAuth);
        if ($authenticatedObject->getUserDetails()->status === UserStatus::INACTIVE) {
            throw ApiException::forbidden('Your account has been disabled');
        }

        /** @var Auth $authToken */
        $authToken = $authenticatedObject->getAuthenticatedCertificates();

        return $authToken;
    }

    /**
     * Verify phone service
     *
     * @param string $phone
     * @return Auth
     */
    public function verifyPhone(string $phone): Auth
    {
        $user = $this->userRepository->findByPhone($phone);
        $accountStatus = AuthAccountStatus::OLD_ACCOUNT;

        if (! $user) {
            // Register new user
            $newUser = new User();
            $newUser->phone = $phone;
            $user = $this->userRepository->save($newUser);
            $accountStatus = AuthAccountStatus::NEW_ACCOUNT;
        }

        if ($user->status === UserStatus::INACTIVE) {
            throw ApiException::forbidden('Your account has been disabled');
        }

        $basicAuth = new PhoneAuthentication("api", $phone);
        $basicAuth->setUserDetails($user);
        $token = \JWTAuth::fromUser($user);
        $authToken = new Auth((string) $token, $accountStatus);
        $basicAuth->setAuthenticatedCertificates($authToken);

        return $authToken;
    }
}
