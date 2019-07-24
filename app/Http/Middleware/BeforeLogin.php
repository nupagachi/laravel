<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Request;

class BeforeLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

       if(Request::hasCookie('uCookie')&&Request::hasCookie('pCookie')){
           $role_id=$request->user()->role_id;
            if($role_id==1){
                return redirect('/admin');
            }else{
                return redirect('/user');
            }
       }else return $next($request);
    }
}
