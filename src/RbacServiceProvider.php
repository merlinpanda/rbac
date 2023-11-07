<?php

namespace Merlinpanda\Rbac;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Merlinpanda\Rbac\Models\App;

class RbacServiceProvider extends ServiceProvider
{
    public function register()
    {
        Request::macro("app", function () {
            $app_key = $this->header("app_key");
            return App::where([
                'app_key' => $app_key,
                'status' => "NORMAL"
            ])->first();
        });
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
