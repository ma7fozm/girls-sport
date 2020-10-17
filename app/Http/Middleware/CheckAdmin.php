<?php

namespace App\Http\Middleware;

use App\Role;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        if (Auth::guard($guard)->check()) {
            $user = Auth::user();
            $role = Role::find($user->roles_id);

            //Checking if user is admin
            if ($role->name == 'سوبر ادمن') {
                return $next($request);

            } else {
                return redirect()->back();
            }
        }

        return $next($request);
    }

}
