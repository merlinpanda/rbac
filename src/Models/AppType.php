<?php

namespace Merlinpanda\Rbac\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppType extends Model
{
    use HasFactory;

    public function apps()
    {
        return $this->hasMany(App::class);
    }

    public function roles()
    {
        return $this->hasMany(AppTypeRbacRole::class);
    }
}
