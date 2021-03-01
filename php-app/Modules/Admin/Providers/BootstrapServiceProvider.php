<?php

namespace Modules\Admin\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Admin\Contracts\Services\UserService;
use Modules\Admin\Contracts\Services\MediaService;
use Modules\Admin\Contracts\Services\MasterCategoryService;
use Modules\Admin\Contracts\Services\ShopService;
use Modules\Admin\Contracts\Clients\StorageClient;
use Modules\Admin\Services\UserServiceImpl;
use Modules\Admin\Services\MediaServiceImpl;
use Modules\Admin\Clients\StorageClientImpl;
use Modules\Admin\Services\MasterCategoryServiceImpl;
use Modules\Admin\Services\ShopServiceImpl;

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
        $this->app->bind(MediaService::class, MediaServiceImpl::class);
        $this->app->bind(StorageClient::class, StorageClientImpl::class);
        $this->app->bind(MasterCategoryService::class, MasterCategoryServiceImpl::class);
        $this->app->bind(ShopService::class, ShopServiceImpl::class);
    }
}
