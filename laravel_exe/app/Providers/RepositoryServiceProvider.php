<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Article\ArticleRepository;
use App\Repositories\Article\ArticleRepositoryInterface;
use App\Repositories\Permission\PermissionRepository;
use App\Repositories\Permission\PermissionRepositoryInterface;
use App\Repositories\Role\RoleRepository;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->singleton(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->singleton(ArticleRepositoryInterface::class, ArticleRepository::class);
        $this->app->singleton(UserRepositoryInterface::class, UserRepository::class);
        $this->app->singleton(PermissionRepositoryInterface::class, PermissionRepository::class);
        $this->app->singleton(RoleRepositoryInterface::class, RoleRepository::class);
    }
}
