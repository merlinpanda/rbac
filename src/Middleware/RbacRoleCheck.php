<?php

namespace Merlinpanda\Rbac\Middleware;

use Closure;
use Merlinpanda\Rbac\Http\Request;
use Illuminate\Support\Facades\Route;
use Merlinpanda\Rbac\Actions\Role\RoutePermissionCheck;
use Merlinpanda\Rbac\Actions\User\AppRole;
use Merlinpanda\Rbac\Exceptions\AccessDeniedException;

class RbacRoleCheck
{
    /**
     * @var RoutePermissionCheck
     */
    protected $checker;

    /**
     * @var AppRole
     */
    protected $appRole;

    public function __construct(RoutePermissionCheck $checker, AppRole $appRole)
    {
        $this->checker = $checker;
        $this->appRole = $appRole;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $uid = $request->user()->payload()->get('uid');

        $app_key = $request->header("App-Key");
        $route_name = Route::currentRouteName();

        if (blank($uid) || blank($app_key) || blank($route_name)) {
            throw new AccessDeniedException("No Access");
        }

        $role = $this->appRole->get($uid, $app_key);
        $has_permission = $this->checker->handle($role, $request->app(), $route_name);
        if (!$has_permission) {
            throw new AccessDeniedException();
        }

        return $next($request);
    }
}
