<?php

namespace Yooconf\Rbac;

use App\Models\App;
use Illuminate\Support\Facades\DB;

class UserApp
{
    public static function menus(App $app, int $role_value)
    {
        $roles = Helpers::getRoleWeights($role_value);

        if (count($roles) == 0) {
            return [];
        }

        $app_type_project_ids = $app->enableProjects()->pluck("app_type_project_id");
        if (! $app_type_project_ids->count()) {
            return [];
        }

        return DB::table("app_type_rbac_roles",'rr')
            ->join("app_type_rbac_role_menus as rrm",'rrm.app_type_rbac_role_id','=','rr.id')
            ->join('app_type_project_menus as pm', 'pm.id', '=', 'rrm.app_type_project_menu_id')
            ->where([
                "rr.app_type_id" => $app->app_type_id,
                "pm.pid" => 0,
                "pm.is_menu" => true,
                "pm.active" => true,
            ])
            ->whereIn("rr.role_value", $roles)
            ->whereIn("pm.app_type_project_id", $app_type_project_ids)
            ->select(["pm.id","pm.icon", "pm.path", "pm.route_name", "pm.title", "pm.sort"])
            ->orderBy("pm.sort", "desc")
            ->get();
    }
}
