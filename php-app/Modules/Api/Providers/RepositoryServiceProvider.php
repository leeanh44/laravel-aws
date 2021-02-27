<?php

namespace Modules\Api\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Api\Contracts\Repositories\Mysql\UserRepository;
use Modules\Api\Contracts\Repositories\Mysql\CategoryRepository;
use Modules\Api\Contracts\Repositories\Mysql\MasterCategoryRepository;
use Modules\Api\Contracts\Repositories\Mysql\ShopRepository;
use Modules\Api\Contracts\Repositories\Mysql\NotificationRepository;
use Modules\Api\Contracts\Repositories\Mysql\ShopUserRepository;
use Modules\Api\Contracts\Repositories\Mysql\ProductRepository;
use Modules\Api\Contracts\Repositories\Mysql\UserDeviceRepository;
use Modules\Api\Contracts\Repositories\Mysql\ShopMasterCategoryRepository;
use Modules\Api\Repositories\Mysql\UserRepoImpl;
use Modules\Api\Repositories\Mysql\CategoryRepoImpl;
use Modules\Api\Repositories\Mysql\MasterCategoryRepoImpl;
use Modules\Api\Repositories\Mysql\ShopRepoImpl;
use Modules\Api\Repositories\Mysql\NotificationRepoImpl;
use Modules\Api\Repositories\Mysql\ShopUserRepoImpl;
use Modules\Api\Repositories\Mysql\ProductRepoImpl;
use Modules\Api\Repositories\Mysql\UserDeviceRepoImpl;
use Modules\Api\Repositories\Mysql\ShopMasterCategoryRepoImpl;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register repositories.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(UserRepository::class, UserRepoImpl::class);
        $this->app->bind(CategoryRepository::class, CategoryRepoImpl::class);
        $this->app->bind(MasterCategoryRepository::class, MasterCategoryRepoImpl::class);
        $this->app->bind(ShopRepository::class, ShopRepoImpl::class);
        $this->app->bind(NotificationRepository::class, NotificationRepoImpl::class);
        $this->app->bind(ShopUserRepository::class, ShopUserRepoImpl::class);
        $this->app->bind(ProductRepository::class, ProductRepoImpl::class);
        $this->app->bind(UserDeviceRepository::class, UserDeviceRepoImpl::class);
        $this->app->bind(ShopMasterCategoryRepository::class, ShopMasterCategoryRepoImpl::class);
    }
}
