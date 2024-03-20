<?php

namespace App\Providers;

use App\View\Components\Layouts\AdminLayout;
use App\View\Components\Layouts\AuthLayout;
use App\View\Components\Layouts\MainLayout;
use App\View\Components\Team\TeamItem;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::component('main-layout', MainLayout::class);
        Blade::component('auth-layout', AuthLayout::class);
        Blade::component('admin-layout', AdminLayout::class);
        Blade::component('team-item', TeamItem::class);


    }
}
