<?php

namespace Merlinpanda\Rbac\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppTypeProject extends Model
{
    use HasFactory;

    public function menus()
    {
        return $this->hasMany(AppTypeProjectMenu::class);
    }

    public function permissions()
    {
        return $this->hasMany(AppTypeProjectPermission::class);
    }
}
