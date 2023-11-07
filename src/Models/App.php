<?php

namespace Merlinpanda\Rbac\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    use HasFactory;

    protected $fillable = [
        "app_type_id", "app_key", "app_secret", "pid", "status"
    ];

    protected $hidden = [
        "app_secret"
    ];

    public function app_users()
    {
        return $this->hasMany(AppUser::class);
    }

    public function app_type()
    {
        return $this->belongsTo(AppType::class);
    }

    public function projects()
    {
        return $this->hasMany(AppProject::class);
    }

    public function enableProjects()
    {
        return $this->projects()->where([
            "app_id" => $this->id,
            "enable" => true,
        ])->whereDate("expired_at", ">", Carbon::now());
    }

    public function target()
    {
        return $this->morphTo();
    }

    public function roles()
    {
        return $this->hasManyThrough(AppTypeRbacRole::class, AppType::class);
    }
}
