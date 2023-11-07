<?php

namespace Merlinpanda\Rbac\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppTypeProject extends Model
{
    use HasFactory;

    protected $fillable = [
        "app_type_id", "name", "title", "status", "version", "version_number"
    ];

    public function menus()
    {
        return $this->hasMany(AppTypeProjectMenu::class);
    }

    public function permissions()
    {
        return $this->hasMany(AppTypeProjectPermission::class);
    }
}
