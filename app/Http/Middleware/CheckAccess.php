<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    // public function checkPermission($getAccess) {
    //     switch (auth()->user()->role) {
    //         case 'user':
    //             return $role = 'user';
    //             break;
    //         case 'admin':
    //             return $role = 'admin';
    //             break;
    //         default:
    //             return 'guest';
    //             break;
    //     }

    //     foreach ($getAccess as $key => $value) {
    //         if ($value == $role) {
    //             dd($user);
    //             return true;
    //         }
    //     }
    //     return false;
    // }

    public function handle($request, Closure $next, ...$roles)
    {
        // Yeah
        if (Auth::check() && in_array(Auth::user()->role, $roles)) {
            return $next($request);
        }

        return redirect('/home'); 
    }
}
