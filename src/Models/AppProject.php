<?php

namespace Merlinpanda\Rbac\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppProject extends Model
{
    use HasFactory;

    protected $fillable = [
        "app_id", "app_type_project_id", "enable", "expired_at"
    ];

    public function project()
    {
        return $this->belongsTo(AppTypeProject::class);
    }
}
