<?php

namespace Yooconf\Rbac\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppType extends Model
{
    use HasFactory;

    public function apps()
    {
        $this->hasMany(App::class);
    }
}
