<?php

namespace Merlinpanda\Rbac\Actions\AppType;

use Illuminate\Support\Facades\Redis;
use Merlinpanda\Rbac\Models\AppTypeRbacRole;

class AppTypeRolePermission
{
    public function get(int $app_type_id, int $role_value): array
    {
        $cache_key = $this->cacheKey($app_type_id, $role_value);
        $permissions = Redis::smembers($cache_key);
        if (!$permissions) {
            $app_type_role = AppTypeRbacRole::where([
                'app_type_id' => $app_type_id,
                'role_value' => $role_value,
            ])->firstOrFail();

            $permissions = $this->permissions($app_type_role);
            if (!blank($permissions)) {
                $permissions = $permissions->toArray();
            } else {
                $permissions = [];
            }

            Redis::sadd($cache_key, $permissions);
        }

        return $permissions;
    }

    private function permissions(AppTypeRbacRole $role)
    {
        return $role->permissions()->pluck("name");
    }

    public function cacheKey(int $app_type_id, int $role_value)
    {
        return sprintf("APP_TYPE:%d:ROLE:%d:PERMISSIONS", $app_type_id, $role_value);
    }
}
