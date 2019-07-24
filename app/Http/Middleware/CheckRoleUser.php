<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckRoleUser
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->role_id == 2) {
            return $next($request);
        }else{
            return response()->view('error.index');
//            $result = 'Error cực mạnh';
//            return view('error.index',compact('result'));
        }
    }
}
