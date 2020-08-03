<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpKernel\Exception\HttpNotFoundException ; 


class CheckRole
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
        if($request->user() === null)
        {
           abort(404);
           //return response('صلاحيات غير كافية',401);
        }
        $actions = $request->route()->getAction();
        $roles = isset($actions['roles']) ? $actions['roles'] : null;   
        //dd($roles);
        if($request->user()->hasAnyRole($roles) || !$roles)
        {
        return $next($request);
        }
        abort(404);
       // return response(401);
    }
}
