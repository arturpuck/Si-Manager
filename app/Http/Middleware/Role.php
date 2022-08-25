<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        
        if($this->userIsAdminOrHasRequiredRoles($roles)) {
            return $next($request);
        }
        abort(403);
    }

    private function userIsAdminOrHasRequiredRoles(array $roles) : bool
    {
        $user = \Auth::user();
        $userRolesArray = $user->roles->pluck('name')->toArray();
        return $user->hasRole('admin') || $this->userHasAllRequiredRoles($roles, $userRolesArray);
    }

    private function userHasAllRequiredRoles(array $requiredRoles, array $presentRoles) : bool
    {
        return count(array_diff($requiredRoles, $presentRoles)) === 0;
    }
}
