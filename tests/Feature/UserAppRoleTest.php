<?php

namespace Tests\Feature;

use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Merlinpanda\Rbac\Actions\User\AppRole;
use Merlinpanda\Rbac\Models\App;
use Tests\TestCase;

class UserAppRoleTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_assign()
    {
        $app = App::find(1);
        $user_id = 1;
        $app_role = new AppRole();
        $app_role->set($user_id, $app, 30);

        $db_save = DB::table("app_users")->where([
            'user_id' => $user_id,
            'app_id' => $app->id,
            'status' => "NORMAL"
        ])->value("role_value");

        $cache_key = $app_role->cacheKey($user_id, $app->app_key);

        $cache_save = Cache::get($cache_key);

        $app_role_get = $app_role->get($user_id, $app->app_key);

        $this->assertEquals(30, $db_save, "数据库存储不正确");
        $this->assertEquals(30, $cache_save, "缓存存储不正确");
        $this->assertEquals(30, $app_role_get, "app role 获取不正确");

    }

    /**
     * 测试授权给不存在的用户
     *
     * @return void
     */
    public function test_user_not_exist()
    {
        try{
            $app = App::find(1);
            $user_id = 10000000;
            $app_role = new AppRole();
            $app_role->set($user_id, $app, 30);

            $this->assertEquals(1,0, "用户不存在时也通过了授权");
        } catch (\Exception $e) {
            $this->assertInstanceOf(QueryException::class, $e);
        }
    }
}
