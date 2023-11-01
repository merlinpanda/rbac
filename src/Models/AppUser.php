<?php

namespace Yooconf\Rbac\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppUser extends Model
{
    use HasFactory;

    public function app()
    {
        return $this->belongsTo(App::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
