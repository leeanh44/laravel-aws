<?php

namespace Modules\Admin\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Admin\Contracts\Repositories\Mysql\UserRepository;
use Modules\Admin\Contracts\Repositories\Mysql\MediaRepository;
use Modules\Admin\Contracts\Repositories\Mysql\MasterCategoryRepository;
use Modules\Admin\Contracts\Repositories\Mysql\ShopRepository;
use Modules\Admin\Repositories\Mysql\UserRepoImpl;
use Modules\Admin\Repositories\Mysql\MediaRepoImpl;
use Modules\Admin\Repositories\Mysql\MasterCategoryRepoImpl;
use Modules\Admin\Repositories\Mysql\ShopRepoImpl;

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
        $this->app->bind(MediaRepository::class, MediaRepoImpl::class);
        $this->app->bind(MasterCategoryRepository::class, MasterCategoryRepoImpl::class);
        $this->app->bind(ShopRepository::class, ShopRepoImpl::class);
    }
}
