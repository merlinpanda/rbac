<?php

namespace Merlinpanda\Rbac;

use Illuminate\Support\ServiceProvider;

class RbacServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../migrations');

        $this->loadTranslationsFrom(__DIR__.'/../lang', 'rbac');
    }
}
