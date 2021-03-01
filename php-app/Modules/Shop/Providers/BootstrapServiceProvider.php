<?php

namespace Modules\Shop\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Shop\Contracts\Services\UserService;
use Modules\Shop\Contracts\Services\MediaService;
use Modules\Shop\Contracts\Services\CategoryService;
use Modules\Shop\Contracts\Services\SubCategoryService;
use Modules\Shop\Contracts\Clients\StorageClient;
use Modules\Shop\Services\UserServiceImpl;
use Modules\Shop\Services\MediaServiceImpl;
use Modules\Shop\Clients\StorageClientImpl;
use Modules\Shop\Services\CategoryServiceImpl;
use Modules\Shop\Services\SubCategoryServiceImpl;

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
        $this->app->bind(CategoryService::class, CategoryServiceImpl::class);
        $this->app->bind(SubCategoryService::class, SubCategoryServiceImpl::class);
    }
}
