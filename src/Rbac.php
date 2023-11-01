<?php

namespace Merlinpanda\Rbac;

use Illuminate\Support\Facades\DB;

class Rbac
{
    public static function getUserRoleValueByAppKey(int $user_id, string $app_key): int
    {
        return DB::table('users')
            ->leftJoin("app_users", "app_users.user_id", "=", "users.id")
            ->leftJoin("apps", "apps.id", "=", "app_users.app_id")
            ->where([
                'users.id' => $user_id,
                'users.status' => "NORMAL",
                'app_users.status' => "NORMAL",
                "apps.app_key" => $app_key
            ])->value("app_users.role_value") ?: 0;
    }
}
