<?php

namespace Merlinpanda\Rbac\Actions\User;

use App\Models\User;
use Merlinpanda\Rbac\Models\App;

/**
 * 给用户分配角色
 */
class AssignRoles
{
    public function handle(User $user, App $app, array $roles = [])
    {
        //
    }
}
