<?php

namespace Merlinpanda\Rbac\Actions\Role;

use Illuminate\Support\Facades\DB;
use Merlinpanda\Rbac\Actions\AppType\AppTypeRolePermission;
use Merlinpanda\Rbac\Helpers;
use Merlinpanda\Rbac\Models\App;

class RoutePermissionCheck
{
    protected $permission;

    public function __construct(AppTypeRolePermission $permission)
    {
        $this->permission = $permission;
    }

    public function handle(int $role, App $app, string $route_name)
    {
        $weights = Helpers::getRoleWeights($role);

        // Todo 需要优化方案，这里计算时间可能会较长
        foreach ($weights as $role_value) {
            $permissions = $this->permission->get($app->app_key_id, $role_value);

            $in = Helpers::routeIn($route_name, $permissions);
            if ($in) {
                return true;
            }
        }

        return false;
    }
}
