<?php

namespace Modules\Api\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Api\Contracts\Securities\AuthenticationManager;
use Modules\Api\Contracts\Services\AuthService;
use Modules\Api\Contracts\Services\UserService;
use Modules\Api\Contracts\Services\CategoryService;
use Modules\Api\Contracts\Services\MasterCategoryService;
use Modules\Api\Contracts\Services\ShopService;
use Modules\Api\Contracts\Clients\StorageClient;
use Modules\Api\Contracts\Adapters\FirebaseAdapter;
use Modules\Api\Contracts\Adapters\JWTAuthAdapter;
use Modules\Api\Contracts\Services\NotificationService;
use Modules\Api\Contracts\Services\ShopUserService;
use Modules\Api\Contracts\Services\ProductService;
use Modules\Api\Securities\Authentications\BasicAuthenticationManager;
use Modules\Api\Services\AuthServiceImpl;
use Modules\Api\Services\UserServiceImpl;
use Modules\Api\Services\CategoryServiceImpl;
use Modules\Api\Services\MasterCategoryServiceImpl;
use Modules\Api\Services\ShopServiceImpl;
use Modules\Api\Clients\StorageClientImpl;
use Modules\Api\Adapters\FirebaseAdapterImpl;
use Modules\Api\Adapters\JWTAuthAdapterImpl;
use Modules\Api\Services\NotificationServiceImpl;
use Modules\Api\Services\ShopUserServiceImpl;
use Modules\Api\Services\ProductServiceImpl;

class BootstrapServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(UserService::class, UserServiceImpl::class);
        $this->app->bind(AuthService::class, AuthServiceImpl::class);
        $this->app->bind(StorageClient::class, StorageClientImpl::class);
        $this->app->bind(FirebaseAdapter::class, FirebaseAdapterImpl::class);
        $this->app->bind(JWTAuthAdapter::class, JWTAuthAdapterImpl::class);
        $this->app->bind(CategoryService::class, CategoryServiceImpl::class);
        $this->app->bind(MasterCategoryService::class, MasterCategoryServiceImpl::class);
        $this->app->bind(ShopService::class, ShopServiceImpl::class);
        $this->app->bind(NotificationService::class, NotificationServiceImpl::class);
        $this->app->bind(ShopUserService::class, ShopUserServiceImpl::class);
        $this->app->bind(ProductService::class, ProductServiceImpl::class);
        $this->app->bind(AuthenticationManager::class, BasicAuthenticationManager::class);
    }
}
