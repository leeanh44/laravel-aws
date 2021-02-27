<?php

namespace Modules\Shop\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Shop\Contracts\Repositories\Mysql\UserRepository;
use Modules\Shop\Contracts\Repositories\Mysql\MediaRepository;
use Modules\Shop\Contracts\Repositories\Mysql\CategoryRepository;
use Modules\Shop\Contracts\Repositories\Mysql\SubCategoryRepository;
use Modules\Shop\Repositories\Mysql\UserRepoImpl;
use Modules\Shop\Repositories\Mysql\MediaRepoImpl;
use Modules\Shop\Repositories\Mysql\CategoryRepoImpl;
use Modules\Shop\Repositories\Mysql\SubCategoryRepoImpl;

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
        $this->app->bind(CategoryRepository::class, CategoryRepoImpl::class);
        $this->app->bind(SubCategoryRepository::class, SubCategoryRepoImpl::class);
    }
}
