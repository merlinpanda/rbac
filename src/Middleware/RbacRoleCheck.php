<?php

namespace Merlinpanda\Rbac\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Merlinpanda\Rbac\Exceptions\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class RbacRoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $uid = $request->user("api")->id;
        $app_key = $request->header("App-Key");
        $route_name = Route::currentRouteName();

        if (blank($uid) || blank($app_key)) {
            throw new AccessDeniedException();
        }

        return $next($request);
    }
}
