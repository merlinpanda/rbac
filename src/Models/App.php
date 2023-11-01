<?php

namespace Yooconf\Rbac\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    use HasFactory;

    public function appType()
    {
        return $this->belongsTo(AppType::class);
    }

    public function enableProjects()
    {
        return $this->hasMany(AppProject::class)->where([
            "app_id" => $this->id,
            "enabled" => true,
        ])->whereDate("expired_at", "<", Carbon::now());
    }

    public function target()
    {
        return $this->morphTo();
    }
}
