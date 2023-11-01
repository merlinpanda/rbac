<?php

namespace Yooconf\Rbac;

use Illuminate\Support\ServiceProvider;

class RbacServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        if (app()->runningInConsole()) {
            $this->publishMigrates();
        }
    }

    public function publishMigrates()
    {
        $this->publishes([
            __DIR__.'/../migrations' => database_path('migrations'),
        ], 'rbac-migrations');
    }
}
