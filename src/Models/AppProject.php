<?php

namespace Merlinpanda\Rbac\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppProject extends Model
{
    use HasFactory;

    public function project()
    {
        return $this->belongsTo(AppTypeProject::class);
    }
}
