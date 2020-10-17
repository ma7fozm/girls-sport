<?php

namespace App\Http\Middleware;

use App\role;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $user = Auth::user();
            $role = Role::find($user->roles_id);

            //Checking if user is admin
            if ($role->name == 'Super admin') {
                return redirect()->intended('admin/');

            } else {
                return redirect()->intended('articles');
            }
        }

        return $next($request);
    }
}
