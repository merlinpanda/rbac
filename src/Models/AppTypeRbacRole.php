<?php

namespace Merlinpanda\Rbac\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppTypeRbacRole extends Model
{
    use HasFactory;

    protected $fillable = [ "app_key_id", "role_value", "name", "title" ];

    public function permissions()
    {
        return $this->hasManyThrough(
            AppTypeProjectPermission::class,
            AppTypeRbacRolePermission::class,
            'role_id',
            'id',
            'id',
            'project_permission_id'
        );
    }
}
