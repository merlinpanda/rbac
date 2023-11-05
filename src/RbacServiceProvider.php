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

        // 发布单元测试
        $this->publishes([
            __DIR__.'/../tests/Feature' => base_path('tests/Feature'),
        ], 'rbac_tests');
    }
}
