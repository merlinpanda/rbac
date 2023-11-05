<?php

namespace Merlinpanda\Rbac\Actions\App;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Merlinpanda\Rbac\Models\App;

class AppPermission
{
    public function get(App $app)
    {
        $cache_key = $this->cacheKey($app->app_type_id);
        $permissions = Redis::smembers($cache_key);
        if (blank($permissions)) {
            $enabled_projects = $app->enableProjects()->pluck("app_type_project_id");

            if (!blank($enabled_projects)) {
                $permissions = DB::table("app_type_project_permissions")->whereIn("app_type_project_id", $enabled_projects)->pluck("name")->toArray();
            } else {
                $permissions = [];
            }

            Redis::sadd($cache_key, $permissions);
        }

        return $permissions;
    }

    public function cacheKey(int $app_type_id)
    {
        return sprintf("APP_TYPE:%d:PERMISSIONS", $app_type_id);
    }
}
