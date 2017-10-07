<?php

namespace App\Http\Middleware;

use App\Http\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Session;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * Check if the user is admin
     *
     * TODO: check for additional user types - eg. staff, moderators etc
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        $guest = !Auth::check();
//        if ($guest) {
//            return redirect('/login');
//        } else {
//            $type = Auth::user()->role->type;
//        }
//        new Request
//        return $next($request);
        if (! Auth::check()) {
            return redirect('/login');
        } elseif (Auth::check()) {

            $type = Auth::user()->role->type;
            if (count($type) > 0) {
                $isAdmin = $type == 'admin' ? true : false;
            } else {
                $isAdmin = false;
            }

            if ($isAdmin == false) {
                Session::flash('alert-danger', 'You are not admin!');

                return redirect('/');
            }
        }



        return $next($request);
    }
}
