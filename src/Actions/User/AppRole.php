<?php

namespace Merlinpanda\Rbac\Actions\User;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Merlinpanda\Rbac\Models\App;
use Merlinpanda\Rbac\Models\AppUser;

class AppRole
{
    /**
     * @param User $user
     * @param string $app_key
     * @return int
     */
    public function get(User $user,string $app_key): int
    {
        $cache_key = $this->cacheKey($user->id, $app_key);
        $role = $this->getRoleFromCache($cache_key);
        if (blank($role)) {
            $role = $this->getRoleFromDB($user->id, $app_key);

            Cache::forever($cache_key, $role);
        }

        return $role;
    }

    /**
     * @param int $user_id
     * @param App $app
     * @param int $role_value
     * @return bool
     */
    public function set(int $user_id, App $app, int $role_value): bool
    {
        $app_user = $app->app_users()->firstOrNew(['user_id' => $user_id]);

        $app_user->role_value = $role_value;
        $rst = $app_user->save();

        if ($rst) {
            $cache_key = $this->cacheKey($user_id, $app->app_key);
            Cache::forever($cache_key, $role_value);
        }

        return $rst;
    }

    /**
     * @param int $user_id
     * @param string $app_key
     * @return string
     */
    public function cacheKey(int $user_id, string $app_key): string
    {
        return sprintf("APP:%s:USER:%d:ROLE", $app_key, $user_id);
    }

    /**
     * @param string $cache_key
     * @return mixed
     */
    private function getRoleFromCache(string $cache_key)
    {
        return Cache::get($cache_key);
    }

    /**
     * @param int $user_id
     * @param string $app_key
     * @return int
     */
    private function getRoleFromDB(int $user_id, string $app_key): int
    {
        $app = App::where(['app_key' => $app_key])->firstOrFaild();

        $role = $app->app_users()->where(['user_id' => $user_id, 'status' => AppUser::STATUS_NORMAL])->value("role_value");

        return $role ?: 0;
    }
}
