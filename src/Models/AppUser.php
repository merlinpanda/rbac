<?php

namespace Merlinpanda\Rbac\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppUser extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "app_id",
        "role_value",
        "status"
    ];

    const STATUS_NORMAL = "NORMAL";

    public function app()
    {
        return $this->belongsTo(App::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
